    function graficar_v1(id_container, id_fuente, titulo, texto_vertical, tipo_grafica, color) {
    	var format_ = '';
    	if(tipo_grafica=='column'){
    		format_ = '{point.y:.1f}';
    	}else{
    		format_ = '<b>{point.name}</b>: {point.percentage:.1f} %';
    	}
    	
        $('#' + id_container).highcharts({   	
            data: {
                table: document.getElementById(id_fuente)
            },
            chart: {
                type: tipo_grafica,
                backgroundColor:color
            },
            title: {
                text: titulo
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: texto_vertical
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>' + this.series.name + '</b><br/>' +
                            this.point.y + ' ' + this.point.name.toLowerCase();
                }
            },
            plotOptions: {
                series: {
                    borderWidth: 1,
                    dataLabels: {
                        enabled: true,
                        format: format_
                    }
                }
            },
        });
    }
    
    
    function graficar_v2(id_container,titulo,categories,texto_vertical,texto_horizontal,data,color) {

    	$('#' + id_container).highcharts({
			chart: {
				type: 'column',
				backgroundColor:color
			},
			title: {
				text: titulo
			},
			xAxis: {
				categories: categories
				
			},
			yAxis: {
				min: 0,
				title: {
					text: texto_vertical
				}
			},
			tooltip: {
				shared: true,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [{
					name: texto_horizontal,
					data: data

				}]
		});
    }