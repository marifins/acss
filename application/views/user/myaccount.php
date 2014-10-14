<?php

function userStr($id) {
    if ($id == "1")
        return "Operator";
    else if ($id == "2")
        return "Administrator";
    else
        return "none";
}

$row = $query;
?>
<?php $base = base_url(); ?>
<style>
    table{
        font-size: 15px;
        font-weight:bold;
        line-spacing:125%;
    }
</style>
<ul class="breadcrumb">
    <li><a href="<?php echo $base; ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">My Account</li>
</ul>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="btn-toolbar">
            <a href="<?php echo $base; ?>" data-toggle="modal" class="btn">Back</a>
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                    <table width="35%">
                        <tr>
                            <td><a>Register</a></td>
                            <td><?php echo $row->register; ?></td>
                        </tr>
                        <tr>
                            <td><a>Username</a></td>
                            <td><?php echo $row->username; ?></td>
                        </tr>
                        <tr>
                            <td><a>Nama Lengkap</a></td>
                            <td><?php echo $row->nama_lengkap; ?></td>
                        </tr>
                        <tr>
                            <td><a>Role</a></td>
                            <td><?php echo userStr($row->level); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
