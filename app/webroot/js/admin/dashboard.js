$(document).ready(function(){
    $.ajax({
        'url' : base_url + 'users/totales',
        'datatype' : 'json',
        'success' : function(obj){
            console.log(obj);
            var total_vendido = obj.total_vendido[0][0].total_vendido;
            $('#contador_usuarios').text(obj.clientes[0][0].total_clientes);
            $('#total_pedidos').text(obj.pedidos_terminados[0][0].pedidos_terminados);
            $('#total_productos').text(obj.total_productos[0][0].total_productos);
            $('#total_vendido').text(Number(total_vendido).toFixed(2));
        }
    });

    $.ajax({
        'url' : base_url + 'pedidos/total_pedidos',
        'datatype' : 'json',
        'success' : function(obj){
            /* 
                Estatus de pedidos
                1= Carrito
                2= Pedido Solicitado
                3= Pedido Aprobado por Duki
                4= Pedido Surtido
                5= Pedido Enviado
                6= Pedido Finalizado
                7= Pedido Cancelado
            */

            Morris.Donut({
                element: 'morris-donut-chart',
                data: [{
                    label: "Pedidos en carrito",
                    value: obj.carrito[0][0].carrito
                }, {
                    label: "Pedidos solicitados",
                    value: obj.solicitado[0][0].solicitado
                }, {
                    label: "Pedidos aprobados",
                    value: obj.aprobado[0][0].aprobado
                }, {
                    label: "Pedidos surtidos",
                    value: obj.surtido[0][0].surtido
                }, {
                    label: "Pedidos enviados",
                    value: obj.enviado[0][0].enviado
                }, {
                    label: "Pedidos cancelados",
                    value: obj.cancelado[0][0].cancelado
                }],
                resize: true
            });
        }
    });

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            iphone: 2666,
            ipad: null,
            itouch: 2647
        }, {
            period: '2010 Q2',
            iphone: 2778,
            ipad: 2294,
            itouch: 2441
        }, {
            period: '2010 Q3',
            iphone: 4912,
            ipad: 1969,
            itouch: 2501
        }, {
            period: '2010 Q4',
            iphone: 3767,
            ipad: 3597,
            itouch: 5689
        }, {
            period: '2011 Q1',
            iphone: 6810,
            ipad: 1914,
            itouch: 2293
        }, {
            period: '2011 Q2',
            iphone: 5670,
            ipad: 4293,
            itouch: 1881
        }, {
            period: '2011 Q3',
            iphone: 4820,
            ipad: 3795,
            itouch: 1588
        }, {
            period: '2011 Q4',
            iphone: 15073,
            ipad: 5967,
            itouch: 5175
        }, {
            period: '2012 Q1',
            iphone: 10687,
            ipad: 4460,
            itouch: 2028
        }, {
            period: '2012 Q2',
            iphone: 8432,
            ipad: 5713,
            itouch: 1791
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        pointSize: 3,
        hideHover: 'auto',
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });
});