ExtensionBuilder.Core.ModelTree = [
 	{
		text: 'Blog',
		children: [
			{
				text: 'Title',
				leaf: true,
				property:true
			},
			{
				text: 'Author',
				leaf: true,
				property:true
			},
			{
				text: 'Posts -> Post',
				leaf: true,
				relation:true
			}
		]
	},
	{
		text: 'Post',
		children: [
			{
				text: 'Title',
				leaf: true,
				property:true
			},
			{
				text: 'Text',
				leaf: true,
				property:true
			},
			{
				text: 'Comments -> Comment',
				leaf: true,
				relation:true
			}
		]
	},
	{
		text: 'Comment',
		children: [
			{
				text: 'Date',
				leaf: true,
				property:true
			},
			{
				text: 'Text',
				leaf: true,
				property:true
			}
		]
	}
 ];

 ExtensionBuilder.Core.ConfigStore = Ext.create('Ext.data.TreeStore', {
    root: {
        expanded: true,
        text: 'Blog Example',
        children: ExtensionBuilder.Core.ModelTree
    }
});

var modelForm = Ext.create('Ext.form.Panel', {
        url:'#',
		id:'ExtensionBuilder.ModelForm',
        frame:true,
        title: 'Blog Model',
		hidden:true,
        bodyStyle:'padding:5px 5px 0',
		margin:20,
        fieldDefaults: {
            msgTarget: 'side',
            labelWidth: 75
        },
        defaultType: 'textfield',
        defaults: {
			width:400
        },

        items: [{
            fieldLabel: 'Name',
            name: 'first',
            allowBlank:false
        },
		{
            name: 'description',
            fieldLabel: 'Description',
            height: 80
        },{
            xtype:'checkbox',
			name: 'aggregate',
            fieldLabel: 'Aggregate root'
        }]
    });

var propertyForm = Ext.create('Ext.form.Panel', {
        url:'#',
        frame:true,
		margin:20,
		hidden:true,
        title: 'Blog properties',
        bodyStyle:'padding:5px 5px 0',
        fieldDefaults: {
            msgTarget: 'side',
            labelWidth: 75
        },
        defaultType: 'textfield',
        defaults: {
			width:400
        },
        items: [{
			xtype:'combo',
			fieldLabel: 'Property type',
			margin:5,
			width:180,
			store: Ext.create('Ext.data.Store', {
			    fields: ['propType', 'propTypeName'],
			    data : [
					{"propType":"1", "propTypeName":"Text"},
			        {"propType":"2", "propTypeName":"Number"},
			        {"propType":"3", "propTypeName":"Date"}
			    ]
			}),
			queryMode: 'local',
			displayField: 'propTypeName',
			valueField: 'propType',
		},
		{
            fieldLabel: 'Name',
            name: 'first',
            allowBlank:false
        },
		{
            name: 'description',
            fieldLabel: 'Description',
            height: 80
        },{
            xtype:'checkbox',
			name: 'exclude',
            fieldLabel: 'Exclude field'
        },{
            xtype:'checkbox',
			name: 'required',
            fieldLabel: 'Required'
        }]
});

var relationForm = Ext.create('Ext.form.Panel', {
        url:'#',
        frame:true,
		margin:20,
		hidden:true,
        title: 'Blog properties',
        bodyStyle:'padding:5px 5px 0',
        fieldDefaults: {
            msgTarget: 'side',
            labelWidth: 125
        },
        defaultType: 'textfield',
        defaults: {
			width:400
        },

        items: [{
            fieldLabel: 'Name',
            name: 'first',
            allowBlank:false
        },
		{
            name: 'description',
            fieldLabel: 'Description',
            height: 80
        },{
            xtype:'checkbox',
			name: 'exclude',
            fieldLabel: 'Lazy loading'
        },{
            xtype:'checkbox',
			name: 'exclude',
            fieldLabel: 'Exclude field'
        },
		{
			xtype:'combo',
			fieldLabel: 'Relation type',
			margin:5,
			width:180,
			store: Ext.create('Ext.data.Store', {
			    fields: ['relType', 'relTypeName'],
			    data : [
					{"relType":"1-1", "relTypeName":"1:1"},
			        {"relType":"1-n", "relTypeName":"1:n"},
			        {"relType":"m-n", "relTypeName":"m:n"}
			    ]
			}),
			queryMode: 'local',
			displayField: 'relTypeName',
			valueField: 'relType',
		}
	]
});