Ext.define('myapp.controller.avance.AvanceController', {
    extend: 'Ext.app.Controller',
    views: ['registrar.Avance',
            'registrar.GridListaAvance',
            'consultar.ListaAvanceFinal',
            'registrar.Gridbuscar',

            ],
     requires: [
        'myapp.util.Util'
    ],
    refs: [
           {
              ref: 'Avance',
              selector: '#formAvance'
             },
            {
              ref: 'GridListaAvance',
              selector: '#gridListaAvance'
             },
             
             {
              ref: 'Gridbuscar',
              selector: '#gridbuscar'
             }
             
           ],
    
    init: function(application) {
        this.control({
            "#formAvance button[name=btnGuardar]":{
                click: this.onClickguardarAvance
            }, 
            "#formAvance button[name=btnCancelar]":{
                 click: this.onClickLimpiarAvance
              },
              "#formAvance button[name=btnLimpiar]":{
                click: this.onClickLimpiarAvance
              },

             "#gridListaAvance button[name=btnAgregarAvance]":{
                click: this.onClickAgregarAvance
              }
             


        }); 
    },   

     onClickguardarAvance:function (button, e, options) {
        formulario=this.getAvance();
        win= this.getGridbuscar();
            var loadingMask = new Ext.LoadMask(Ext.getBody(), { msg: "grabando..." });
                loadingMask.show();

                formulario.getForm().submit({ //AQUI ENVIO LA DATA 
                    url: BASE_URL+'avance/avance/registrarAvance',
                    method:'POST',
                    params:formulario.getForm().getValues(),
                    success: function(form, action){
                        var result = action.result;           
                        loadingMask.hide();
                       
                        if (result.success){
                              
                              Ext.MessageBox.show({ title: 'Alerta', msg:  result.msg, buttons: Ext.MessageBox.OK, icon: Ext.MessageBox.WARNING });
                              win.close();
                            }
                        else{
                           Ext.MessageBox.show({ title: 'Alerta', msg:  result.msg, buttons: Ext.MessageBox.OK, icon: Ext.MessageBox.WARNING });
                           // myapp.util.Util.showErrorMsg(result.msg);
                        }
                    },
                    failure: function(form,action){
                    var result = action.result;    
                     loadingMask.hide();
                            Ext.MessageBox.show({ title: 'Alerta', msg:result.msg , buttons: Ext.MessageBox.OK, icon: Ext.MessageBox.WARNING });
                        }
                    
                });

        
    },// fin de la function 

 onClickLimpiarAvance:function(form) {
         formulario=this.getAvance();
         formulario.getForm().reset();

    },// fin de la function 

 changeFecha:function(form) {
         formulario=this.getAvance();
         formulario.getForm().reset();

    },

    onClickAgregarAvance: function(button, e, options)
    {
           
          var win=Ext.create('myapp.view.registrar.Gridbuscar');
           win.show();
          
           
    },


});