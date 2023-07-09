function loadPage() {
    let helper = new Helper();
    let ctxVentasProductos = document.getElementById("productosVendidos");
    let ctxProductosCategoria = document.getElementById("ventasPorCategoria");
    let ctxComparacionVentas = document.getElementById("compraracionVentas");
    let listaColores = [ 
        'rgba(255, 99, 132)',
        'rgba(255, 159, 64)',
        'rgba(255, 205, 86)',
        'rgba(75, 192, 192)',
        'rgba(54, 162, 235)',
        'rgba(153, 102, 255)',
        'rgba(201, 203, 207)'
    ];
    let listaBordes = [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
    ];
    let datosVentas = {
        labels: ['Leche Gloria', 'Cafe Instantaneo', 'Leche Condenzada', 'Aceite Vegetal', 'Big Cola'],
        datasets: [{
            label : 'Productos',
            barPercentage: 0.5,
            data: [12, 19, 3, 5, 2],
            backgroundColor: listaColores,
            borderColor: listaBordes,
            borderWidth: 1
        }]
    };
    let myChartVentas = new Chart(ctxVentasProductos.getContext('2d'), {
        type: 'bar',
        data: datosVentas,
        options: {
            responsive:true,
            plugins : {
                legend : {
                    labels : {
                        generateLabels : function(e){
                            return [
                                {
                                    text : "Leche Gloria",
                                    fillStyle: listaColores[0],
                                    strokeStyle: listaBordes[0]
                                },
                                {
                                    text : "Cafe Instantaneo",
                                    fillStyle: listaColores[1],
                                    strokeStyle: listaBordes[1]
                                },
                                {
                                    text : "Leche Condenzada",
                                    fillStyle: listaColores[2],
                                    strokeStyle: listaBordes[2]
                                },
                                {
                                    text : "Aceite Vegetal",
                                    fillStyle: listaColores[3],
                                    strokeStyle: listaBordes[3]
                                },
                                {
                                    text : "Big Cola",
                                    fillStyle: listaColores[4],
                                    strokeStyle: listaBordes[4]
                                }
                            ]
                        }
                    },
                    position : 'right',
                    title : {text: 'Leyenda'}
                }
            }
        }
    });
    let datosCategorias = {
        labels:['Leche Gloria', 'Cafe Instantaneo', 'Leche Condenzada', 'Aceite Vegetal', 'Big Cola'],
        datasets: [{
          data: [300, 50, 100,60,80],
          backgroundColor: listaColores,
          hoverOffset: 1,

        }],
    };
    let myChartVentasCategoria = new Chart(ctxProductosCategoria.getContext('2d'), {
        type: 'pie',
        data: datosCategorias,
        options: {
            responsive:true,
            plugins : {
                legend : {
                    position : 'right'
                }
            },
        }
    });
    let myChartComparacionVentas = new Chart(ctxComparacionVentas.getContext('2d'), {
        type:'line',
        data : {
            labels : ['Abril','Mayo','Junio','Julio'],
            datasets: [
                {
                    label : 'Año 2022',
                    data: [300, 50, 100,60,80],
                    backgroundColor : listaColores[0],
                    borderColor : listaColores[0]
                },
                {
                    label : 'Año 2023',
                    data: [100, 20, 80,150,200],
                    backgroundColor : listaColores[1],
                    borderColor : listaColores[1]
                }
            ],
        }
    })
    const tablaRanking = document.querySelector("#tablaRankign");
    const txtFechaInicio = document.querySelector("#txtFechaInicio");
    const txtFechaFin = document.querySelector("#txtFechaFin");
    async function cargarDashboard(){
        if(!txtFechaInicio.value || !txtFechaFin.value){
            return helper.alertaToast("error","Establesca los parametros de fecha correctas");
        }
        let datos = new FormData();
        datos.append("fInicio",txtFechaInicio.value);
        datos.append("fFin",txtFechaFin.value);
        datos.append("acciones",'solicitar-datos');
        try {
            const response = await fetch(helper.urlDashboardBodega,{
                method:"POST",
                body : datos
            }).then(result => result.json());
            //LLENADO DE DATOS PARA EL GRAFICO LINEAL
            myChartComparacionVentas.data.labels = response.ventasRealizadas.year1.map(mes => mes.nombreMes);
            myChartComparacionVentas.data.datasets[1].data = response.ventasRealizadas.year1.map(mes => mes.montoVendido);
            myChartComparacionVentas.data.datasets[0].data = response.ventasRealizadas.year2.map(mes => mes.montoVendido);
            myChartComparacionVentas.update();
            //LLENADO DE DATOS PARA EL GRAFICO DEL PASTEL
            myChartVentasCategoria.data.labels = response.productosVendidosCategoria.map(categoria => categoria.nombreCategoria);
            myChartVentasCategoria.data.datasets[0].data = response.productosVendidosCategoria.map(categoria => categoria.cantidadVendida);
            myChartVentasCategoria.update();
            //LLENADO DE DATOS PARA EL GRAFICO DE BARRAS
            myChartVentas.data.labels = response.productosVendidos.map(producto => producto.nombre);
            myChartVentas.data.datasets[0].data = response.productosVendidos.map(producto => producto.cantidadVendida);
            // myChartVentas.options.plugins.legend.labels;
            myChartVentas.options = {
                responsive:true,
                plugins : {
                    legend : {
                        labels : {
                            generateLabels : function(e){
                                let datos = [];
                                response.productosVendidos.forEach((producto,key) => {
                                    datos.push({
                                        text : producto.nombre,
                                        fillStyle: listaColores[key],
                                        strokeStyle: listaBordes[key]
                                    })
                                });
                                return datos;
                            }
                        },
                        position : 'right',
                        title : {text: 'Leyenda'}
                    }
                }
            }
            myChartVentas.update();
            //RACKIN BODEGAS
            let template = "";
            response.rankingBodegas.forEach((bodega,key) => {
                template +=`<tr>
                <td>${key + 1}</td>
                <td>${bodega.nombreBodega}</td>
                <td>${helper.resetearMoneda(bodega.montoVendido)}</td>
                </tr>`
            });
            tablaRanking.innerHTML = !template ? `<tr><td colspan="100%" class="text-center">No se encontraron registros</td></tr>` : template; 
        } catch (error) {
            console.error(error);
        }
    }
    cargarDashboard();
    for (const filtro of document.querySelectorAll(".filtro-aplicar")) {
        filtro.addEventListener("change",cargarDashboard);
    }
    document.querySelector("#btnImprimirPdf").onclick = function(e){
        window.print();
    }
}
window.addEventListener("DOMContentLoaded",loadPage);