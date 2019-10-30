var pdfMake = require("pdfmake/build/pdfmake.js");
var pdfFonts = require('pdfmake/build/vfs_fonts.js');

pdfMake.vfs = pdfFonts.pdfMake.vfs;

export default{
    methods:{
        initDocumentDefinition(){
           const dd = {
              pageMargins: [ 40, 40, 10, 10],
              pageSize: 'A4',
              content:[],
              styles:{
                 header:{
                    fontSize: 20,
                    bold: true,
                    alignment: 'center',
                    margin: [0,0,0,20]
                 },
                 justified:{
                    fontSize: 12,
                    alignment: 'justify'
                 },
                 text:{
                    margin:[0,0,0,20]
                 }
              }
           };
           return dd;
        },
        getHeader(head){
            const header = {
                text: head,
                style: 'header',
                alignment: 'center',
                margin: [2, 20, 2, 10],
                headlineLevel: 1
              };
              return header;
        },
        getControlDate(control){
            const now = moment(Date.now()).format('DD-MM-YYYY HH:mm:ss');
            const controlDate = {
              columns: [
                 {
                    text: 'Fecha y Hora ' + now,
                    style: 'subheader',
                    alignment: 'left'
                 },
                 {
                    text: ` N° de Control: ${control}`,
                    style: 'subheader',
                    alignment: 'right'
                 },
              ]
            };
            return controlDate;
        },
        getTable(body){
            const table = {
              style: 'tableExample',
              color: '#444',
              table: {
                 widths: [
                    '16%',
                    '*',
                    '16%',
                    '16%',
                    '16%',
                    '16%'
                 ],
                 body: body
              }
            };
            return table;
        },
        getUserSector(user, radioLocation, deliver) {
            const userSector= [
               [
              {
                 text: `${deliver ? 'EGRESO' : 'INGRESO'} DEL EQUIPO - PERSONAL INTERVINIENTE`,
                 style: 'tableHeader',
                 colSpan: 6,
                 alignment: 'center'
              },
              {},
              {},
              {},
              {},
              {}
           ],
               [
              {
                 text: '',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: `${deliver ? 'RECIBE' : 'ENTREGA'}`,
                 style: 'tableHeader',
                 colSpan: 3,
                 alignment: 'center'
              },
              {},
              {},
              {
                 text: `${deliver ? 'ENTREGA' : 'RECIBE'}`,
                 style: 'tableHeader',
                 colSpan: 2,
                 alignment: 'center'
              },
              {}
           ],
               [
              {
                 text: 'GRADO',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: '',
                 style: 'tableHeader',
                 colSpan: 3,
                 alignment: 'center'
              },
              {},
              {},
              {
                 text: user.grade,
                 style: 'tableHeader2',
                 colSpan: 2,
                 alignment: 'center'
              },
              {}
           ],
               [
              {
                 text: 'LEGAJO',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: '',
                 style: 'tableHeader',
                 colSpan: 3,
                 alignment: 'center'
              },
              {},
              {},
              {
                 text: user.file_number.toString(),
                 style: 'tableHeader2',
                 colSpan: 2,
                 alignment: 'center'
              },
              {}
           ],
               [
              {
                 text: 'APELLIDO',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: '',
                 style: 'tableHeader',
                 colSpan: 3,
                 alignment: 'center'
              },
              {},
              {},
              {
                 text: user.surname,
                 style: 'tableHeader2',
                 colSpan: 2,
                 alignment: 'center'
              },
              {}
           ],
               [
              {
                 text: 'FIRMA',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: '',
                 style: 'tableHeader',
                 colSpan: 3,
                 alignment: 'center'
              },
              {},
              {},
              {
                 text: '',
                 style: 'tableHeader2',
                 colSpan: 2,
                 alignment: 'center'
              },
              {}
           ],
               [
              {
                 text: 'DESTINO',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: radioLocation,
                 style: 'tableHeader3',
                 colSpan: 3,
                 alignment: 'center'
              },
              {},
              {},
              {
                 text: 'División ENLACES TRONCALIZADOS',
                 style: 'tableHeader3',
                 colSpan: 2,
                 alignment: 'center'
              },
              {}
           ]
            ];
          return userSector;
        },
        getRadioSector(repair) {
            const radioSector = [
               [
              {
                 text: 'DATOS DEL EQUIPO',
                 style: 'tableHeader',
                 colSpan: 6,
                 alignment: 'center'
              },
              {},
              {},
              {},
              {},
              {}
           ],
               [
              {
                 text: 'MARCA',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: repair.radio.brand,
                 style: 'tableHeader2',
                 alignment: 'center'
              },
              {
                 text: 'MODELO',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: repair.radio.model,
                 style: 'tableHeader2',
                 alignment: 'center'
              },
              {
                 text: 'SERIE',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: repair.radio.serial,
                 style: 'tableHeader2',
                 alignment: 'center'
              }
           ],
               [
              {
                 text: 'BATERÍA',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: repair.hasBattery ? 'SI' : 'NO',
                 style: 'tableHeader2',
                 alignment: 'center'
              },
              {
                 text: 'ANTENA',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: repair.hasAntenna ? 'SI' : 'NO',
                 style: 'tableHeader2',
                 alignment: 'center'
              },
              {
                 text: 'MIC DE PALMA',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: repair.hasMicrophone ? 'SI' : 'NO',
                 style: 'tableHeader2',
                 alignment: 'center'
              }
           ],
               [
              {
                 text: 'ASIGNADO A',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: repair.radio.sector.name,
                 style: 'tableHeader3',
                 alignment: 'center'
              },
              {
                 text: 'FALLA',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: repair.reason,
                 style: 'tableHeader2',
                 alignment: 'center'
              },
              {
                 text: 'COD. DEP.',
                 style: 'tableHeader',
                 alignment: 'center'
              },
              {
                 text: repair.radio.sector.code,
                 style: 'tableHeader2',
                 alignment: 'center'
              }
           ]
            ];
            return radioSector;
        },
        getLastRow(text){
            const lastRow = [
               {
                  text: text,
                  style: 'tableHeader3',
                  border: [
                     false,
                     false,
                     false,
                     true
                  ],
                  colSpan: 6,
                  alignment: 'left'
               },
               {},
               {},
               {},
               {},
               {}
            ];
            return [lastRow];
        },
        crearReciboIngreso(repairs, user) {
            const dd = {
              content: this.getPage(repairs, user),
              pageBreakBefore: function(currentNode, followingNodesOnPage, nodesOnNextPage, previousNodesOnPage) {
                 return (currentNode.headlineLevel === 1 && previousNodesOnPage.length > 1);
              },
              styles: this.appStyle,
              defaultStyle: {
                 // alignment:'justify'
              }
           };
            return dd;
        },
        crearReciboEgreso(repair, user) {
            const dd = {
               content: [
                  this.getHeader('División ENLACES TRONCALIZADOS - CONSTANCIA DE EQUIPO EN REPARADO'),
                  this.getControlDate(repair.control_number),
                  this.getTable(this.getRadioSector(repair).concat(this.getUserSector(user, repair.radio.sector.name, true))),
               ],
               styles: this.appStyle,
               defaultStyle: {
                  // alignment:'justify'
               }
            };
            return dd;
        },
        getPage(repairs, user){
            let content = [];
            repairs.forEach(
              (repair) => {
                content = content.concat(
                  [
                    this.getHeader('División ENLACES TRONCALIZADOS - CONSTANCIA DE EQUIPO EN REPARACIÓN'),
                    this.getControlDate(repair.control_number),
                    this.getTable(this.getRadioSector(repair).concat(this.getUserSector(user, repair.radio.sector.name))),
                    this.getTable(this.getLastRow('Informes al 5816,2249 y 1514. Talon para ' + repair.radio.sector.name)),
                    this.getControlDate(repair.control_number),
                    this.getTable(this.getRadioSector(repair).concat(this.getUserSector(user, repair.radio.sector.name))),
                    this.getTable(this.getLastRow('Informes al 5816,2249 y 1514. Talon para División ENLACES TRONCALIZADOS')),
                    this.getControlDate(repair.control_number),
                    this.getTable(this.getRadioSector(repair)),
                    this.getTable(this.getLastRow('Talon para el equipo.'))
                  ]
                );
              }
            );
            return content;
        },
        openPDF(dd) {
           return pdfMake.createPdf(dd).open();
        },
        crearReciboDevolucion(response){
           var data = JSON.parse(response.config.data);
           var productData = [];
           var dependencia = data.dependence.name;
           data.products.forEach(product => {
              productData.push(product.quantity+' '+product.name+' '+product.description);
           });
           var dd = this.initDocumentDefinition();
           dd.content = dd.content.concat(
            [
               this.getHeader('RECIBO'),
               {
                  text: 'Recibi de la '+ dependencia +' en calidad de devolución el siguiente equipamiento:',
                  alignment: 'justify',
                  margin: [0,20]
               },
               {
                  ul:productData
               },
               {
                  text: 'Fecha:' + moment().format('DD-MM-YYYY'),
                  alignment: 'right'
               },
               {
                   text:'\nFirma...............................................\n\n'
               },
               {
                   text:'Aclaración...............................................\n\n'
               },
               {
                   text: 'Dependencia: División ENLACES TRONCALIZADOS'
               }
           ]
           ); 
           this.openPDF(dd);
        },
        crearReciboEntrega(response){
            var data = JSON.parse(response.config.data);
            var productData = [];
            var dependencia = data.dependence.code+' '+data.dependence.name;
            data.products.forEach(product => {
               productData.push(product.quantity+' '+product.name+' '+product.description);
            });
            var dd = this.initDocumentDefinition();
            dd.content = dd.content.concat(
                [
                    this.getHeader('RECIBO'),
                    {
                       text: 'Recibi de la División ENLACES TRONCALIZADOS de la SUPERINTENDENCIA FEDERAL DE TECNOLOGIAS DE LA INFORMACION Y COMUNICACIONES el siguiente equipamiento:',
                       alignment: 'justify',
                       margin: [0,20]
                    },
                    {
                       ul:productData
                    },
                    {
                       text: 'Fecha:' + moment().format('DD-MM-YYYY'),
                       alignment: 'right'
                    },
                    {
                        text:'\nFirma...............................................\n\n'
                    },
                    {
                        text:'Aclaración...............................................\n\n'
                    },
                    {
                        text: 'Dependencia: '+dependencia
                    }
                ]
            );
            this.openPDF(dd);
        }
    }
};