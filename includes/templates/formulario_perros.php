<div class="row">
    <div class="col-12">
        <div class="form-group">
            <input class="form-control valid" name="perro[nombre]" id="nombre" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa el nombre'" placeholder="Nombre" value="<?php echo s($perro->nombre); ?>">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control valid" name="perro[raza]" id="raza" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la raza'" placeholder="Raza" value="<?php echo s($perro->raza); ?>">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input class="form-control valid" name="perro[edad]" id="edad" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la edad'" placeholder="Edad" value="<?php echo s($perro->edad); ?>"">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <select class="form-control" name="perro[genero]" id="genero" ">
                <option value="" selected>Selecciona el género</option>
                <option value="macho">Macho</option>
                <option value="hembra">Hembra</option>
            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <textarea class="form-control w-100" name="perro[descripcion]" id="descripcion" cols="30" rows="6" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la descripción'" placeholder="Descripción" value="<?php echo s($perro->descripcion); ?>"></textarea>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control" name="perro[extra]" id="extra" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa información extra'" placeholder="Información Extra" value="<?php echo s($perro->extra); ?>">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <p>Agrega una imagen</p>
            <input class="form-control" name="perro[imagen]" id="imagen" type="file" accept="image/jpeg, image/png">
        </div>
    </div>
    <?php if ($perro->imagen) { ?>
            <img src="/imagenes/<?php echo $perro->imagen; ?>" alt="Imagen del perro" class="imagen-small">
    <?php } ?>  
    <!-- <div class="col-sm-6">
        <div class="form-group">
            <p>Seleccione un refugio asociado</p>
            <select name="Refugio_idRefugio">
                <option value="">-- Seleccione --</option>
                <?php while ($refugio = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $Refugio_idRefugio === $refugio['idPerro'] ? 'selected' : ''; ?> value="<?php echo s($perro->refugio['idPerro']); ?>">
                        <?php echo $refugio['nombre']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
    </div> -->
</div>
<div class="form-group mt-3">
</div>