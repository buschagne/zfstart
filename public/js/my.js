	
	$(function() {
		
		$( "#accordion" ).accordion();
		

		
		var availableTags = [
			"Kosi Bay","Swaziland","Sodwana","Ponta du Ouro","Rocktail","Bhanga Nek","Manzengwenya","Manguzi","Kwangwanase","Umhlabayalingana","Tembe","Thonga","Maputaland",
"loggerhead","leatherback","turtle","bird watching","pels fishing owl","palmnut vulture","kosi hiking trail","hiking","slackpacking","slackpacker",
"Memela","bush camp","Maputaland","Kosibay","Elephant Coast","KwaZulu Natal","Mozambique","Mocambique",
"accommodation","camping","Guesthouse","lodge",
"Kosi Bay Lodge","Thobeka","Maputaland lodge","Kosi Bay Cabins",
"Kosi","Kozi","Kozi bay","Kosibay",
"self-catering","selfcatering","self catering","catered",
"Overnight","Holiday","Business","Vacation","Excursions",
"Zulu Land","Zululand","Maputaland","Isimangaliso","Isimangaliso Wetland Park","Greater St Lucia Wetlands Park","GSLWP","Lake Nhlange",
"fishing","rock and surf fishing","freshwater fishing","saltwater fishing","salt water fishing","fly-fishing","snorkelling","kingfish","turtles"
		];
		$( "#autocomplete" ).autocomplete({
			source: availableTags
		});
		

		
		$( "#button" ).button();
		$( "#radioset" ).buttonset();
		

		
		$( "#tabs" ).tabs();
		

		
		$( "#dialog" ).dialog({
			autoOpen: false,
			width: 400,
			buttons: [
				{
					text: "Ok",
					click: function() {
						$( this ).dialog( "close" );
					}
				},
				{
					text: "Cancel",
					click: function() {
						$( this ).dialog( "close" );
					}
				}
			]
		});

		// Link to open the dialog
		$( "#dialog-link" ).click(function( event ) {
			$( "#dialog" ).dialog( "open" );
			event.preventDefault();
		});
		

		
		$( "#datepicker" ).datepicker({
			inline: true
		});
		

		
		$( "#slider" ).slider({
			range: true,
			values: [ 17, 67 ]
		});
		

		
		$( "#progressbar" ).progressbar({
			value: 20
		});
		

		// Hover states on the static widgets
		$( "#dialog-link, #icons li" ).hover(
			function() {
				$( this ).addClass( "ui-state-hover" );
			},
			function() {
				$( this ).removeClass( "ui-state-hover" );
			}
		);
	});
	
