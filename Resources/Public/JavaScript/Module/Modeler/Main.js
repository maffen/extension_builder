Ext.define('ExtensionBuilder.Module.Modeler.Main', {
	extend: 'ExtensionBuilder.Module.AbstractModule',
	alias: 'widget.ExtensionBuilder.Module.Modeler.Main',
	id: 'ExtensionBuilder.Module.Modeler.Main',
	layout:'border',
	defaults: {
	    collapsible: true,
	    split: true,
	},
	items: [{
			title: 'Console',
			region: 'south',
			height: 150,
			minSize: 75,
			maxSize: 250,
			cmargins: '5 0 0 0',
			collapsed: true,
			padding:3,
			html:'Extension with extKey "Blogexample" loaded in 0.56 s'
		},{
			title: 'Existing Models',
			region:'west',
			collapsed:true,
			width: 175,
			minSize: 100,
			maxSize: 250,
			margins: '0 5 0 0',
			items:Modeler_importList
		},{
			title: 'Blog Model',
			id:'ExtensionBuilder.Modeler.propertyPanel',
			region:'east',
			width: 350,
			minSize: 100,
			maxSize: 350,
			collapsed: true,
			items: [
				Modeler_blogForm,
				{
					title:'Attributes',
					items:[
						Modeler_nameForm,
						Modeler_authorForm,
						{
							xtype:'button',
							text:'Add new property',
							margin: 5
						}
					]
				}
			]
		},{
			title: 'Modeler',
			collapsible: false,
			collapsed:false,
			region:'center',
			margins: '5 0 0 0',
			bodyStyle:{
				'background-color':'#f4e99c'
			},
			items:[
				{
					xtype:'button',
					text: 'Add new model',
					width: 100,
					margin: 8,
					tooltip:'If you want to add existing models, open left panel'
				},
				{
					html:'<img title="Click here to edit properties" id="umlDummy" src="../typo3conf/ext/extension_builder/Resources/Public/Images/uml-blogexample.png" style="margin-top:100px;margin-left:100px;cursor:pointer;" />',
					bodyStyle:{
						'background-color':'#f4e99c'
					},
					border:false,
					listeners:{
						click: {
				            element: 'el', //bind to the underlying el property on the panel
				            fn: function(){
								Ext.getCmp('ExtensionBuilder.Modeler.propertyPanel').expand();
							}
				        }
					}
				}
			]
	}],

	initComponent: function() {
		Ext.apply(this, {});
		this.callParent(arguments);
	}
});

ExtensionBuilder.Core.registerModule('ExtensionBuilder.Module.Modeler.Main', 'Modeler');