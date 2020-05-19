   
        $('.shop-insert').click(function(){
            $('.lightbox').css('display','block');
            $('.lightclose').css('height','100vh');
            $('.lightclose').css('opacity','1');
        })
        $('.lightclose').click(function(){
            $('.lightclose').css('height','100vh');
            $('.lightbox').css('display','none');
            $('.lightclose').css('opacity','0');
            
        })