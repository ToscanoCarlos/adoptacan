<div class="row">
    <div class="col-12">
        <div class="form-group">
            <input class="form-control valid" name="nombre" id="nombre" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa el nombre'" placeholder="Nombre" value="<?php echo $nombre; ?>">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control valid" name="raza" id="raza" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la raza'" placeholder="Nombre" value="<?php echo $raza; ?>">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input class="form-control" name="edad" id="edad" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la edad'" placeholder="Edad" value="<?php echo $edad; ?>">
        </div>
    </div>
    <div class=" col-sm-6">
        <div class="form-group">
            <select class="form-control" name="genero" id="genero" value="<?php echo $genero; ?>">
                <option value="" selected>Selecciona el género</option>
                <option value=" Macho">Macho</option>
                <option value="Hembra">Hembra</option>
            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <textarea class="form-control w-100" name="descripcion" id="descripcion" cols="30" rows="6" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la descripción'" placeholder="Descripción"><?php echo $descripcion; ?></textarea>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control" name="extra" id="extra" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa información extra'" placeholder="Información Extra" value="<?php echo $extra; ?>">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <p>Agrega una imagen</p>
            <input class="form-control" name="imagen" id="imagen" type="file" accept="image/jpeg, image/png">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <p>Seleccione un refugio asociado</p>

            <select class="form-control" name="Refugio_idRefugio" value="<?php echo $Refugio_idRefugio; ?>">
                <option value="">Seleccione el refugio asociado</option>
                <?php while ($refugio = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $Refugio_idRefugio === $refugio['idRefugio'] ? 'selected' : ''; ?> value="<?php echo $refugio['idRefugio']; ?>">
                        <?php echo $refugio['nombre']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>
</div>
<div class="form-group mt-3">
</div>
</div>


<!-- <select class="form-control" name="perro_idperro" id="perro">
                <option value="" selected>Selecciona el perro</option>
                <option value="1">Milagros Caninos</option>
                <option value="2">San Gregorio</option>
                <option value="3">AdoptaCDMX</option>
                <option value="4">Esperanza en 4 Patas</option>
                </select> -->