



































// var bloque1= {

//     conf: {
//         nombre: '#bloque_1',
//         visible: true

//     },
    
//     template: $('#bloque_1'),

//     mostrar : function(){

       
//         console.log(this.conf.visible);

//     },

//     init: function()
//     {
//         if(this.conf.visible){

//             this.mostrar(true);
//         }else{

//             this.mostrar(false);
//         }


//         this.bindSex();
//         this.bindEdad();

//     },

    
//     bindEdad: function(){

//         $( "#b1_edad" ).on('change, click' ,function(){

//                 if($(this).val() < 2 || $(this).val() ){

//                     bloque3_a.mostrar(true);
//                         console.log("es bebe")
//                 }else{



//                     bloque4.mostrar(true);
                    
                    
//                 }
//                 console.log($(this).val())

//         })


//     },

//     bindSex: function(){

//                 $( "#bloque_1 input[name$='genderRadios']" ).on('click', function(){

//                 if($(this).val() == 'm'){

//                     bloque3_a.mostrar(false);
//                     bloque4.mostrar(false);
//                     bloque7.mostrar(false);

//                 }else{

//                     bloque4.mostrar(true);
                    
                    
//                 }
                

//         })
//     }






// } ;


// var bloque2= {

//     conf: {
//         nombre: '#bloque_2',
//         visible: false

//     },

//     template: $('#bloque_2'),

//         mostrar : function(valor)
//         {

//             if (valor)
//             {
//                 this.template.show();
//             }else
//             {
//                 this.template.hide();
//             }
//         },

//         init: function()
//         {
//             if(this.conf.visible){

//                 console.log('esta visible');
//             }else{

//                 this.mostrar(false);
//             }



//         }
// } ;



// var bloque3_a= {

//     conf: {
//         nombre: '#bloque_3_a',
//         visible: false

//     },

//     template: $('#bloque_3_a, #bloque_3_b'),

//         mostrar : function(valor)
//         {

//             if (valor)
//             {
//                 this.template.show();
//             }else
//             {
//                 this.template.hide();
//             }
//         },

//         init: function()
//         {
//             if(this.conf.visible){

//                 console.log('esta visible');
//             }else{

//                 this.mostrar(false);
//             }
//         }

// } ;


// var bloque3_b= {

//     conf: {
//         nombre: '#bloque_3_b',
//         visible: false

//     },

//     template: $('#bloque_3_b'),

//         mostrar : function(valor)
//         {

//             if (valor)
//             {
//                 this.template.show();
//             }else
//             {
//                 this.template.hide();
//             }
//         },

//         init: function()
//         {
//             if(this.conf.visible){ this.mostrar(true); }else{ this.mostrar(false); }




//         }

// } ;


// var bloque4= {

//     conf: {
//         nombre: '#bloque_4',
//         visible: false

//     },

//     template: $('#bloque_4'),

//         mostrar : function(valor)
//         {

//             if (valor)
//             {
//                 this.template.show();
//             }else
//             {
//                 this.template.hide();
//             }
//         },

//         init: function()
//         {
//             if(this.conf.visible){

//                 console.log('esta visible');
//             }else{

//                 this.mostrar(false);
//             }

//             console.log('Bloque 4 mujeres');

//         }

// } ;


// var bloque5= {

//     conf: {
//         nombre: '#bloque_5',
//         visible: false

//     },

//     template: $('#bloque_5'),

//         mostrar : function(valor)
//         {

//             if (valor)
//             {
//                 this.template.show();
//             }else
//             {
//                 this.template.hide();
//             }
//         },

//         init: function()
//         {
//             if(this.conf.visible){

//                 console.log('esta visible');
//             }else{

//                 this.mostrar(false);
//             }

//             console.log('Bloque 5 Adultos mayores');

//         }

// } ;



// var bloque6= {

//     conf: {
//         nombre: '#bloque_6',
//         visible: false

//     },

//     template: $('#bloque_6'),

//         mostrar : function(valor)
//         {

//             if (valor)
//             {
//                 this.template.show();
//             }else
//             {
//                 this.template.hide();
//             }
//         },

//         init: function()
//         {
//             if(this.conf.visible){

//                 console.log('esta visible');
//             }else{

//                 this.mostrar(false);
//             }

//             console.log('Bloque 6 discapacidad');

//         }

// } ;




// var bloque7= {

//     conf: {
//         nombre: '#bloque_7',
//         visible: false

//     },

//     template: $('#bloque_7'),

//         mostrar : function(valor)
//         {

//             if (valor)
//             {
//                 this.template.show();
//             }else
//             {
//                 this.template.hide();
//             }
//         },

//         init: function()
//         {
//             if(this.conf.visible){

//                 console.log('esta visible');
//             }else{

//                 this.mostrar(false);
//             }

//             console.log('Bloque 7 Embarazadas');

//         }

// } ;




$(function() {

    $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true
    })

});