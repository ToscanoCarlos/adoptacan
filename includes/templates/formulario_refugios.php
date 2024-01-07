<div class="row">
    <div class="col-12">
        <div class="form-group">
            <input class="form-control valid" name="refugio[nombre]" id="nombre" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa el nombre'" placeholder="Nombre" value="<?php echo s($refugio->nombre); ?>">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input class="form-control valid" name="refugio[email]" id="email" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la email'" placeholder="email" value="<?php echo s($refugio->email); ?>">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input class="form-control valid" name="refugio[telefono]" id="telefono" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la telefono'" placeholder="telefono" value="<?php echo s($refugio->telefono); ?>"">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <textarea class="form-control w-100" name="refugio[ubicacion]" id="ubicacion" cols="30" rows="6" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la descripción'" placeholder="Descripción" value="<?php echo s($refugio->ubicacion); ?>"></textarea>
        </div>
    </div>
</div>    