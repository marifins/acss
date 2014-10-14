/**
 *
 *
 * @copyright 2010
 * @author Muhammad Arifin Siregar
 * @package main
 * @modified Sep 17, 2010
 */

var base = window.location.protocol + "//" + window.location.host +"/rekanan/";
var sub_bidang = "";
$(function() {
    //var coba = ["Leveransir", "Konstruksi", "Asuransi", "Konsultansi"];
    $('#id_bidang').hide();
    $('.id_sub').hide();
    $('.id_cat').hide();
    $('.cat').hide();
    $('.sub_bidang').attr("disabled", true);
    //$('.tambah').hide();
    // $('.delete').hide();
    $("#bidang").autocomplete({
        source: base+"rekanan/get_bidang2",
        minLength: 0,
        select: function(event, ui) {
            $('#id_bidang').val(ui.item.id);
            $('.sub_bidang').attr("disabled", false);
            $('.tambah').show();
            $('.delete').show();
            
            sub_bidang = getSUB($('#id_bidang').val());
            sub_bidang = JSON.parse(sub_bidang); // String to JSON
            setSUB();
        }
    }).focus(function() {
        $(this).autocomplete("search");
    });
    
    $("#clear_bidang").click(function(){
        $("#bidang").val("");
        $('.sub_bidang').val("");
        $('.sub_bidang').attr("disabled", true);
        $('.tambah').hide();
        $('.delete').hide();
    });
    
    $("#main_search").submit(function(){
        var str = $("input[name='search']").val();
        if(str == ""){
            alert('Silahkan tentukan keyword pencarian!');
            return false;
        }else{
            return true;
        }
    });

});

function getSUB(id_bidang) {
    var json = "";
    $.ajax({
        url: base + "rekanan/get_sub_bidang3/" +id_bidang,
        async: false,
        success: function(msg) {
            json = msg;
        }
    });
    return json;
}

function setSUB() {
    $(".sub_bidang").catcomplete({
        source: sub_bidang,
        minLength: 0,
        select: function(event, ui) {
            sub_bidang.removeValue('id', ui.item.id);
            $(".id_sub").val(ui.item.id);
            $(".id_cat").val(ui.item.id_cat);
            $(".cat").val(ui.item.category);
        }
    }).focus(function() {
        $(this).catcomplete("search");
    });
}

Array.prototype.removeValue = function(name, value){
    var array = $.map(this, function(v,i){
        return v[name] === value ? null : v;
    });
    this.length = 0; //clear original array
    this.push.apply(this, array); //push all elements except the one we want to delete
}

$(document).ready(function() {
    // $('.date').datepicker();
    $('.date').datepicker({
        dateFormat: 'dd-mm-yy'
    });
});
/**************** Category Autocomplete***************/
$.widget("custom.catcomplete", $.ui.autocomplete, {
    _renderMenu: function(ul, items) {
        var that = this,
        currentCategory = "";
        $.each(items, function(index, item) {
            if (item.category != currentCategory) {
                ul.append("<li class='ui-autocomplete-category'>" + item.category + "</li>");
                currentCategory = item.category;
            }
            that._renderItemData(ul, item);
        });
    }
});
/************ End of Category Autocomplete************/

/* Edit
 * Tampilkan popup, parsing url,  load form edit
 */
$(document).delegate('.edit', 'click', function() {
    open();
});

$(document).delegate('#popup .close', 'click', function() {
    close();
});

$(document).delegate('.add', 'click', function() {
    open();
});

$(document).delegate('.delete', 'click', function() {
    var a = $(this).closest('ul').closest('li');
    var id_sub = a.children('input.id_sub').val();
    var sub = a.children('input.sub_bidang').val();
    var id_cat = a.children('input.id_cat').val();
    var cat = a.children('input.cat').val();
    if(id_sub.length > 0) sub_bidang.push({
        id: id_sub, 
        label: sub, 
        id_cat: id_cat, 
        category: cat
    });

//alert(JSON.stringify(sub_bidang));
//sub_bidang.push({"id":id_sub,"label":sub,"id_cat":id_cat,"category":cat});

//alert(JSON.stringify(sub_bidang));
    
});

$(document).delegate('.filter-button', 'click', function() {
    $('#filter-box').slideToggle();
});

/*Add Sub Bidang
 *
 */
$(document).delegate('#add-sub-bidang', 'click', function() {
    var len = sub_bidang.length;
    if(len > 0){
        $('.form[name="bidang-usaha"] > ul').append('<li><input class="sub_bidang long" type="text" /><input class="id_sub" type="text" /><input class="id_cat" type="text" /><input class="cat" type="text" /><ul class="horizontal-list right"><li><a class="icon delete" href="javascript:;" title="Hapus"><span>Hapus</span></a></li></ul></li>');
        $('.id_sub').hide();
        $('.id_cat').hide();
        $('.cat').hide();
        setSUB();
        $('.form[name="bidang-usaha"] > ul > li:last-child > input').focus();
    }else{
        alert('Anda telah memilih seluruh Sub Bidang!');
    }
});

$(document).delegate('', 'click', function() {
    qSearch();
});

$(document).delegate('.form[name="bidang-usaha"] .delete', 'click', function() {
    $(this).closest('ul.horizontal-list').parent().remove();
});

/*FUNCTIONS*/

/*Open popup*/
function open() {
    var height = (($(window).height() - 200) - ($('#popup').height())) / 2;
    var width = (($(window).width()) - ($('#popup').width())) / 2;

    $('#popup').css({
        'top': height, 
        'left': width
    }).toggle();
    $('#popup').show();
    $('#mask').show();
}

/*Close popup*/
function close() {
    $('#popup').hide();
    $('#mask').fadeOut();
}

/*Filter*/
function filter() {
    $('.form[name="filter-drt"]').html();
}

/*Search*/
function qSearch() {

}

/*Simpan data*/
function save() {

}

/*Kirim data*/
function pass(retrievedData, passedUrl, changedDiv) {
    $.ajax({
        url: passedUrl,
        type: 'POST',
        data: retrievedData,
        success: function(msg) {
            $(changedDiv).html(msg);
        }
    });
}


function load(page,div){
    var image_load = "<div class='ajax_loading'><img src='"+loading_image_large+"' /></div>";
    $.ajax({
        url: site+"/"+page,
        beforeSend: function(){
            $(div).html(image_load);
        },
        success: function(response){
            $(div).html(response);
        },
        dataType:"html"
    });
    return false;
}

function l(page){
    var a = false;
    $.ajax({
        url: site+"/"+page,
        success: function(response){
            if(response > 0) a = true;
        }
    });
    return a;
}