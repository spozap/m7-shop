<header>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">    
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/register.css">    
 
    <!-- Load Leaflet from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
            integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
            crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.5.3/dist/esri-leaflet.js"
        integrity="sha512-K0Vddb4QdnVOAuPJBHkgrua+/A9Moyv8AQEWi0xndQ+fqbRfAFd47z4A9u1AW/spLO0gEaiE1z98PK1gl5mC5Q=="
        crossorigin=""></script>
    <!-- Geocoding Control -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
        integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
        crossorigin="">
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
        integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
        crossorigin=""></script>

</header>

<body>
	<div class="container pt-5">
		<h4 class="text-center">Username register</h4>
		<div class="row">
			<div class="col-6">
				<form id="form-user-register" method="post">
					<div class="form-row mb-4">
						<div class="col-6">
							<label for="username">Username*</label>
							<div class="input-group">
								<input type="text" class="form-control" id="username" value="" name="username">
								<div class="invalid-feedback"></div>
							</div>
						</div>
					</div>

					<div class="form-row mb-4">
						<div class="col-6">
							<label for="email">Email*</label>
							<input type="email" class="form-control" id="email" name="email">
							<div class="invalid-feedback"></div>
						</div>
					</div>

                    <div class="form-row mb-4">
                        <div class="col-6">
                            <label for="passwdInput" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <div class="invalid-feedback"></div>
                        </div>  
                    </div>

					<div class="form-row mb-4">
						<div class="col-3">
							<label for="">Via</label>
							<select class="custom-select" id="via" name="via">
								<option value="1">Carrer</option>
								<option value="2">Torrent</option>
								<option value="3">Avinguda</option>
							</select>
						</div>

						<div class="col-7">
							<label for="">Nom</label>
							<input type="text" class="form-control" id="nomCarrer" name="nomCarrer">
						</div>

						<div class="col-2">
							<label for="">Número</label>
							<input type="text" class="form-control" id="numCarrer" name="numCarrer">
						</div>
					</div>

					<div class="form-row mb-4">
						<div class="col-6">
							<label for="">Poblacio</label>
							<input type="text" class="form-control" id="poblacio" name="poblacio">
						</div>
					</div>
					<input type="hidden" name="lat" value="" id="latitude" name="latitude"/>  
					<input type="hidden" name="lng" value="" id="longitude" name="longitude"/>  		
	
					<button class="btn btn-primary" id="registerBtn">Registrar</button>
				</form>
			</div>

			<div class="col-6 pt-5">
				<div id="map">
				</div>
				<button type="button" class="btn btn-secondary mt-2" id="findLoc">Buscar adreça</button>  
			</div>		
		</div>

	</div>
    <script src="../js/register.js"></script>
</body>