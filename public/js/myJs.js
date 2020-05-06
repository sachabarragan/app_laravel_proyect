window.addEventListener("load", function(){
    var url = 'http://420time.la/';

    function desvotacion(){
            $('.votacion').unbind('click').click(function(){
            console.log("No va a votar");
            $(this).next().removeClass('mostrarse').addClass('escondido');
            votacion();
        });
    }
    desvotacion();

    function votacion(){

           
            $('.votacion').unbind('click').click(function(){

            $(this).next().removeClass('escondido').addClass('mostrarse'); 

            desvotacion();
        });
    }
    votacion();

    $( ".botonVotar" ).click(function() {
        
        $.ajax({
            url: url+'like/like?'+'came_from=home&_token=g5qJAE4JM0Sn60u34mey1FAeQdVQSoqgcK7UyI5B&weed_id='+($(this).parent().prev().parent().data('id'))+'&would_smoke='+($(this).parent().prev().parent().children().children('.smokeSi').children('.smokeInputDiv').children().val())+'&would_eat='+($(this).parent().prev().parent().children().children('.eatSi').children('.eatInputDiv').children().val())+'&would_plant='+($(this).parent().prev().parent().children().children('.plantSi').children('.plantInputDiv').children().val())+'&it_hits_me='+($(this).parent().prev().parent().children().children('.hitSi').children('.hitInputDiv').children().val())+'&would_share='+($(this).parent().prev().parent().children().children('.shareSi').children('.shareInputDiv').children().val()),
            type: 'GET',
            success: function(response){
                
                if(response.like){

                    $(".weed_id_"+response.like.weed_id).prev().prev().children().children('.smoke').removeClass('bg00').addClass('bg0'+response.like.would_smoke);
                    $(".weed_id_"+response.like.weed_id).prev().prev().children().children('.share').removeClass('bg00').addClass('bg0'+response.like.would_share);
                    $(".weed_id_"+response.like.weed_id).prev().prev().children().children('.plant').removeClass('bg00').addClass('bg0'+response.like.would_plant);
                    $(".weed_id_"+response.like.weed_id).prev().prev().children().children('.eat').removeClass('bg00').addClass('bg0'+response.like.would_eat);
                    $(".weed_id_"+response.like.weed_id).prev().prev().children().children('.hit').removeClass('bg00').addClass('bg0'+response.like.it_hits_me);

                    
                    //Borrar el boton VOTAR
                    $(".weed_id_"+response.like.weed_id).prev().replaceWith('<h6 class="d-flex justify-content-center">Ya votaste esta weed</h6>')

                    $(".weed_id_"+response.like.weed_id).removeClass('mostrarse').addClass('escondido');
                    console.log("paso el IF");
                    
                    
                }else{
                    console.log('Error al dar like');
                    console.log(response);
                }
            }
            
         });
         votacion();
    });

    $('#buscador').submit(function(e){
		$(this).attr('action',url+'user/index/'+$('#buscador #search').val());
	});
});