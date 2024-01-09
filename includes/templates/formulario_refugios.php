<div class="row">
    <div class="col-12">
        <div class="form-group">
            <input class="form-control valid" name="nombre" id="nombre" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa el nombre'" placeholder="Nombre" value="<?php echo $nombre; ?>">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
        <input class="form-control valid" name="email" id="email" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la email'" placeholder="Email" value="<?php echo $email; ?>">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control" name="telefono" id="telefono" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la telefono'" placeholder="Teléfono" value="<?php echo $telefono; ?>">
        </div>
    </div>
        <div class="col-12">
            <div class="form-group">
                <textarea class="form-control w-100" name="ubicacion" id="ubicacion" cols="30" rows="6" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la descripción'" placeholder="Ubicación" value="<?php echo $ubicacion; ?>"></textarea>
            </div>
        </div>
</div>