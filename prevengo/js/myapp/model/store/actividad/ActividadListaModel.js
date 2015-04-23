Ext.define('myapp.model.store.actividad.ActividadListaModel', { 
   extend: 'Ext.data.Model',
    idProperty: 'id',
    fields: [
        { name: 'idactividad'},
        { name: 'descripcion'},
    ] 
});