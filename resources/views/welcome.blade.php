<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="robots" 	content="noindex">
		<meta name="viewport" 	content="width=device-width, initial-scale=1">

		<title>
			Clinic App | {{ config("app.name") }}
		</title>

		<link rel="stylesheet" type="text/css" href="{{ asset('resources/css/body.css') }}">
	</head>
	<body>
		<section>
			<div>
				<img src="{{ asset('resources/image/clinic-app-logo.png') }}"/>
				<h5>
					<span>
						{{ config("app.name") }}
					</span>
					<span>
						{{ config("app.version") }}
					</span>
				</h5>
				<p>
					&copy; 2024 Clinic App - Todos los derechos reservados.
				</p>
			</div>
		</section>
	</body>
</html>
