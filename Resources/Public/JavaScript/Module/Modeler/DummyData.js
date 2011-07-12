var Modeler_authorForm = Ext.create('Ext.form.Panel', {
	url:'#',
	frame:true,
	width:'100%',
	title: 'Author',
	collapsible:true,
	collapsed: true,
	fieldDefaults: {
		msgTarget: 'side',
		labelWidth: 75
	},
	defaultType: 'textfield',
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

var Modeler_nameForm = Ext.create('Ext.form.Panel', {
	url:'#',
	frame:true,
	title: 'Name',
	width:'100%',
	collapsible:true,
	collapsed: true,
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

var Modeler_blogForm = Ext.create('Ext.form.Panel', {
	url:'#',
	frame:true,
	fieldDefaults: {
		msgTarget: 'side',
		labelWidth: 75
	},
	defaultType: 'textfield',
	defaults: {
		width:400
	},
	
	items: [
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
			name: 'aggregate',
            fieldLabel: 'Aggregate root'
    }]
});

var Modeler_importList = [{
			title: 'BlogExample',
			border: false,
			iconCls: 'nav',
			items:[
				{html:'<label>Blog</label><button style="float:right">Extend</button>'},
				{html:'<label>Post</label><button style="float:right">Extend</button>'},
				{html:'<label>Comment</label><button style="float:right">Extend</button>'}
			]
		}, {
			title: 'TYPO3',
			border: false,
			iconCls: 'settings',
			items:[
				{html:'<label>Frontend-User</label><button style="float:right">Extend</button>'},
				{html:'<label>Backend-User</label><button style="float:right">Extend</button>'},
				{html:'<label>Adress <br />(tt_address)</label><button style="float:right">Extend</button>'},
				{html:'<label>News <br />(tt_news)</label><button style="float:right">Extend</button>'}
			]
		}, {
			title: 'Imported Models',
			border: false,
			iconCls: 'settings',
			items:[
				{html:'<label>Immo-XML</label><button style="float:right">Add</button>'},
				{html:'<label>MyExt-&gt;Book</label><button style="float:right">Add</button>'},
				{html:'<label>MyExt-&gt;Person</label><button style="float:right">Add</button>'},
				{html:'<label>MyExt-&gt;Author</label><button style="float:right">Add</button>'},
				{html:'<label>Calendar</label><button style="float:right">Extend</button>'}
			]
		}
];