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
			text:'Extension with extKey "Blogexample" loaded in 0.56 s'
		},{
			title: 'Models',
			region:'west',
			width: 175,
			minSize: 100,
			maxSize: 250,
			margins: '0 5 0 0',
			items: [
				{
					title:'New model',
					html:'<label>New empty model</label><button style="float:right">Add</button>',
					preventHeader:true,
					cls:'addModel',
					style:{
						margin:'10px 0'
					}
				},
				{
					title:'Existing models',
					collapsed:false,
					collapsible:true,
					defaults:{
						cls:'addModel',
						collapsible:true
					},
					items:[{
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
					}]
				}
			]
		},{
			title: 'Properties',
			region:'east',
			width: 175,
			minSize: 100,
			maxSize: 250,
			layout: {
				type: 'accordion',
				animate: true
			},
			collapsed: true,
			items: [
				{
					title:'Blog Properties',
					collapsible:true
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
			// dummy uml image for T3DD11
			html:'<img src="../typo3conf/ext/extension_builder/Resources/Public/Images/uml-blogexample.png" style="margin-top:100px;margin-left:100px" />'
	}],

	initComponent: function() {
		Ext.apply(this, {});

		this.callParent(arguments);
	}


});

ExtensionBuilder.Core.registerModule('ExtensionBuilder.Module.Modeler.Main', 'Modeler');