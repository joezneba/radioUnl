<?php

$descripcion = array(
    'name' => 'descripcion',
    'id' => 'descripcion',
    'maxlength' => 250,
    'value' => set_value('descripcion'),
    'type' => 'text',
    'class' => 'required form-control',
    'placeholder' => 'Ingrese el la descricpcion'
);
$correo = array(
    'name' => 'correo',
    'id' => 'correo',
    'maxlength' => 100,
    'value' => set_value('correo'),
    'type' => 'text',
    'class' => 'required form-control',
    'placeholder' => 'Ingrese el o los correos'
);
$telefono = array(
    'name' => 'telefono',
    'id' => 'telefono',
    'maxlength' => 100,
    'value' => set_value('telefono'),
    'type' => 'text',
    'class' => 'required form-control',
    'placeholder' => 'Ingrese el telefono'
);
?>
<script>
    function validarFormulario() {
        jQuery.validator.messages.required = "<code>Esta campo es obligatorio.</code>";
        jQuery.validator.messages.number = "<code>Esta campo debe ser num&eacute;rico.</code>";
        jQuery.validator.messages.minlength = "<code>Debe contener mínimo 4 numeros.</code>";
        $("#formulario").validate();
    }
    $(document).ready(function() {
        validarFormulario();
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <span class="glyphicon glyphicon-th-list"></span> <?php echo $title; ?>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-home"></i> <a href="<?php echo base_url() ?>index.php/login/page_Admin">Inicio</a>
            </li>
            <li class="active">
                <i class="fa fa-list"></i> <?php echo $title; ?>
            </li>
        </ol>
    </div>
</div>
<div>    
    <?php
    if ($this->session->flashdata('error')) {
        echo "<div class='alert alert-success text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>";
        echo '<h4><center>' . $this->session->flashdata('error') . '</h4></center>';
        echo "</div>";
    }
    echo form_open_multipart('informacion/guardarInformacion/', 'id="formulario" name="formulario"class="form-horizontal"');
    ?>
    <div class="wrapper">
        <div class="form-group col-lg-12">
            <label for="Nombre" class="col-lg-2 control-label">DESCRIPCION: </label>
            <div class="col-lg-4">
                <?php echo form_input($descripcion); ?>
            </div>
        </div>
        <div class="form-group col-lg-12">
            <label for="Estatus" class="col-lg-2 control-label">CORREO: </label>
            <div class="col-lg-4">
                <?php echo form_input($correo); ?>
            </div>
        </div>
        <div class="form-group col-lg-12">
            <label for="Estatus" class="col-lg-2 control-label">TEFEFONO: </label>
            <div class="col-lg-4">
                <?php echo form_input($telefono); ?>
            </div>
        </div>     

        <div class="form-group col-lg-12">
            <div class="col-lg-10">
                <a type="button" href="<?php echo base_url(); ?>index.php/login/page_Admin" class="btn btn-default">Regresar</a>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Guardar</button>
            </div>
        </div>
        <hr/>
    </div>
    <?php echo form_close(); ?>
</div>