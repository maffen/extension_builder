var extensionStore = Ext.create('Ext.data.Store', {
    fields: ['extensionKey', 'extensionName'],
    data : [
        {"extensionKey":"new", "extensionName":"New extension"},
		{"extensionKey":"blog_example", "extensionName":"Blog example"},
        {"extensionKey":"my_ext1", "extensionName":"My Extension 1"},
        {"extensionKey":"my_ext2", "extensionName":"My Extension 2"}
    ]
});

// Create the combo box, attached to the states data store
var extList = Ext.create('Ext.form.ComboBox', {
	fieldLabel: 'Select Extension',
	labelStyle:"color:#FFFFFF;font-weight:bold",
	labelWidth:100,
	margin:5,
    store: extensionStore,
    queryMode: 'local',
    displayField: 'extensionName',
    valueField: 'extensionKey',
	flex:1
});

Ext.define('ExtensionBuilder.Components.UserInterface.Header', {
	extend: 'Ext.container.Container',
	alias: 'widget.ExtensionBuilder.Components.UserInterface.Header',
	initComponent: function() {
		Ext.apply(this, {
			height: '70px',
			layout: 'fit',
			bodyStyle:{
				'background-color':'#888888'
			},
			border:false,
			items: [{
					layout:'hbox',
					defaults:{
						border:false,
						bodyStyle:{
							'background-color':'#888888'
						}
					},
					items:[
						{
							flex:1,
							bodyStyle:{
								'background-color':'#888888'
							},
							items:[
								{
									layout: 'table',
									columns: 3,
									border:false,
									bodyStyle:{
										'background-color':'#888888'
									},
									items: [extList, {
										xtype: 'button',
										text: 'Load',
										width: 60,
										margin: 8,
										tooltip:'Do we need this, or should the extension be loaded onselect?'
									}, {
										xtype: 'button',
										text: 'Save',
										width: 60,
										margin: 8,
										tooltip:'This should be dectivated if the extension did not validate'
									}]
								}
							]
						},
						{
							width:80,
							border:false,
							items:[
								{
									xtype: 'button',
									text: 'Help',
									width:60,
									margin:8,
									tooltip:'Open a help page on wiki.typo3.org'
								}
							]
						}
					]
				}
			]
		});

		this.callParent(arguments);
	}
});

