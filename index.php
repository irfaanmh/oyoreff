<!DOCTYPE html>
<html>
<head>
	<title>HMKK &mdash; OYO Rooms</title>
	<link rel="shortcut icon" href="http://gnt.at/favicon.png" type="image/x-icon">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style type="text/css">
		html,
		body {
			font-family: "Courier New";
			font-size: 12pt;
			text-align: center;
		}

		table {
			text-align: center;
		}

		a {
			text-decoration: none;
			color: #000000;
		}

		input,
		select,
		button {
			text-align: center;
			font-family: "Courier New";
			width: 120px;
			padding: 3px;
			margin-top: 5px;
			margin-bottom: 5px;
		}

		input {
			width: 330px;
		}

		table {
			text-align: left;
		}

		h3 {
			margin-block-start: 0.5em;
			margin-block-end: 0.5em;
		}

		td {
			word-wrap: break-word;
			padding: 0px;
		}

		@media (max-width: 650px) {
			input,
			select,
			button {
				font-size: 10pt;
				width: 115px;
				padding-top: 5px;
				padding-bottom: 5px;
			}

			input {
				width: 323px;
			}

			.input {
				font-size: 10pt;
				padding-top: 5px;
				padding-bottom: 5px;
			}

			td {
				max-width: 250px;
			}
		}
	</style>
</head>
<body>

	<hr />

	<div id="akun"></div>

	<hr />

	<h4 style="font-family: Roboto; margin: 10px;">
		<a href="https://api.whatsapp.com/send?phone=6282350952330" target="_blank">Made with <span style="color: #e25555;">&hearts;</span> by Alvriyanto Azis</a>
	</h4>

	<hr />

	<div id="referral">
		<input type="text" class="input" placeholder="Masukkan kode referral" />
	</div>
	<div id="otp">
		<select class="negara" style="width: 60px;">
			<option value="62">+62</option>
			<option value="1">+1</option>
		</select>
		<input type="tel" class="telepon" placeholder="81234567890" style="width: 130px;">
		<button class="tombol">Kirim OTP</button>
	</div>
	<div id="daftar">
		<input type="number" class="input" placeholder="Masukkan kode OTP." disabled="true" style="width: 200px;">
		<button class="tombol" disabled="true">Daftar</button>
	</div>

	<hr />

	<input type="text" id="akun_ke" placeholder="Akun ke-I" value="0" style="display: none;">

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script type="text/javascript">
		$(document).ready(async function() {
			var site_api	= "api.php";
			var keterangan	= "";

			$("#otp .telepon").keyup(function(){
				$("#telepon .tombol").html("Kirim");
				$("#daftar .input").attr("disabled", "true");
				$("#daftar .tombol").attr("disabled", "true");

				$("#daftar .input").val("");
			});

			$("#otp .tombol").on("click", function() {
				return $.ajax({
					url: site_api+"?opsi=otp",
					dataType: "json",
					type: "POST",
					data : {
						"negara":  $("#otp .negara").val(),
						"telepon":  $("#otp .telepon").val()
					},
					beforeSend: function() {
						$("#otp .negara").attr("disabled", "true");
						$("#otp .telepon").attr("disabled", "true");
						$("#otp .tombol").attr("disabled", "true");
						$("#daftar .input").attr("disabled", "true");
						$("#daftar .tombol").attr("disabled", "true");
					},
					success: function(response) {
						if (response.status === true && response.keterangan === "Pengguna baru.") {
							$("#otp .negara").removeAttr("disabled");
							$("#otp .telepon").removeAttr("disabled");
							$("#otp .tombol").removeAttr("disabled");
							$("#otp .tombol").html("Kirim Ulang");
							$("#daftar .input").removeAttr("disabled");
							$("#daftar .tombol").removeAttr("disabled");
						}
						else {
							swal({
								title: "Gagal",
								text: response.keterangan,
								icon: "error",
								button: "Tutup"
							});

							$("#otp .negara").removeAttr("disabled");
							$("#otp .telepon").removeAttr("disabled");
							$("#otp .tombol").removeAttr("disabled");
						}
					},
					error: function (jqXHR, exception) {
						if (jqXHR.status === 0) {
							keterangan = "Not connect (verify network).";
						} else if (jqXHR.status == 404) {
							keterangan = "Requested page not found.";
						} else if (jqXHR.status == 500) {
							keterangan = "Internal Server Error.";
						} else if (exception === "parsererror") {
							keterangan = "Requested JSON parse failed.";
						} else if (exception === "timeout") {
							keterangan = "Time out error.";
						} else if (exception === "abort") {
							keterangan = "Ajax request aborted.";
						} else {
							keterangan = "Uncaught Error ("+jqXHR.responseText+").";
						}

						swal({
							title: "Gagal",
							text: keterangan,
							icon: "error",
							button: "Tutup"
						});

						$("#otp .negara").removeAttr("disabled");
						$("#otp .telepon").removeAttr("disabled");
						$("#otp .tombol").removeAttr("disabled");
					}
				});
			});

			$("#daftar .tombol").on("click", async function() {
				return $.ajax({
					url: site_api+"?opsi=daftar",
					dataType: "json",
					type: "POST",
					data : {
						"negara":  $("#otp .negara").val(),
						"telepon":  $("#otp .telepon").val(),
						"referral":  $("#referral .input").val(),
						"otp":  $("#daftar .input").val()
					},
					beforeSend: function() {
						$("#referral .input").attr("disabled", "true");
						$("#otp .negara").attr("disabled", "true");
						$("#otp .telepon").attr("disabled", "true");
						$("#otp .tombol").attr("disabled", "true");
						$("#daftar .input").attr("disabled", "true");
						$("#daftar .tombol").attr("disabled", "true");
					},
					success: function(response) {
						if (response.status === true) {
							var akun	= parseInt($("#akun_ke").val()) + 1;
							var data	= response.keterangan;

							$("#akun_ke").val(akun);

							$("#akun").append(`
								<hr style="max-width: 500px;" />
								<table align="center">
									<tbody>
										<tr>
											<td colspan="3" style="text-align: center;">
											<h4 style="margin: 0px;">Akun ke-`+akun+`</h4>
											</td>
										</tr>
										<tr>
											<td>Telepon</td>
											<td>:</td>
											<td class="telepon">`+data.telepon+`</td>
										</tr>
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td class="nama">`+data.nama+`</td>
										</tr>
										<tr>
											<td>Email</td>
											<td>:</td>
											<td class="email">`+data.email+`</td>
										</tr>
									</tbody>
								</table>
								<hr style="max-width: 500px;" />
							`);

							$("#otp .negara").removeAttr("disabled");
							$("#otp .telepon").removeAttr("disabled");
							$("#otp .tombol").removeAttr("disabled");
							$("#otp .tombol").html("Kirim OTP");

							$("#otp .telepon").val("");
							$("#daftar .input").val("");
						}
						else {
							swal({
								title: "Gagal",
								text: response.keterangan,
								icon: "error",
								button: "Tutup"
							});

							$("#daftar .input").removeAttr("disabled");
							$("#daftar .tombol").removeAttr("disabled");
						}
						
						$("#referral .input").removeAttr("disabled");
					},
					error: function (jqXHR, exception) {
						if (jqXHR.status === 0) {
							keterangan = "Not connect (verify network).";
						} else if (jqXHR.status == 404) {
							keterangan = "Requested page not found.";
						} else if (jqXHR.status == 500) {
							keterangan = "Internal Server Error.";
						} else if (exception === "parsererror") {
							keterangan = "Requested JSON parse failed.";
						} else if (exception === "timeout") {
							keterangan = "Time out error.";
						} else if (exception === "abort") {
							keterangan = "Ajax request aborted.";
						} else {
							keterangan = "Uncaught Error ("+jqXHR.responseText+").";
						}

						swal({
							title: "Gagal",
							text: keterangan,
							icon: "error",
							button: "Tutup"
						});

						$("#daftar .input").removeAttr("disabled");
						$("#daftar .tombol").removeAttr("disabled");
						$("#referral .input").removeAttr("disabled");
					}
				});
			});
		});
	</script>
</body>
</html>