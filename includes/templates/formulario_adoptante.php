<div class="row">
    <div class="col-12">
        <div class="form-group">
            <input class="form-control valid" name="nombre" id="nombre" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa el nombre'" placeholder="Nombre">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control valid" name="apellido" id="apellido" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa el apellido'" placeholder="Apellido">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control" name="edad" id="edad" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la edad'" placeholder="Edad">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control" name="direccion" id="direccion" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la dirección'" placeholder="Dirección">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control" name="ciudad" id="ciudad" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa la ciudad'" placeholder="Ciudad">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control" name="codigo_postal" id="codigo_postal" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa el código postal'" placeholder="Código Postal">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa el correo electrónico'" placeholder="Correo Electrónico">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control" name="telefono" id="telefono" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa el teléfono'" placeholder="Teléfono">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control" name="experiencia_mantenimiento_mascotas" id="experiencia_mantenimiento_mascotas" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Experiencia en mantenimiento de mascotas'" placeholder="Experiencia en mantenimiento de mascotas">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <textarea class="form-control w-100" name="motivo_adopcion" id="motivo_adopcion" cols="30" rows="6" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa el motivo de adopción'" placeholder="Motivo de adopción"></textarea>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <input class="form-control" name="espacio_disponible" id="espacio_disponible" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresa el espacio disponible'" placeholder="Espacio disponible">
        </div>
    </div>
    <input type="hidden" name="nombrePerro" value="<?php echo htmlspecialchars($nombrePerro); ?>">
    <input type="hidden" name="perroId" value="<?php echo htmlspecialchars($perroId); ?>">
    <input type="hidden" name="refugioNombre" value="<?php echo htmlspecialchars($refugioNombre); ?>">

    </div>
