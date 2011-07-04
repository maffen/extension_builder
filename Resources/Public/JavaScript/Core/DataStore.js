Ext.ns('ExtensionBuilder.Core');

ExtensionBuilder.Core.on('pre-init', function() {
	var directFn = function(node, callback) {
		TYPO3.ExtensionBuilder.ExtDirect.readModel(callback);
//		TYPO3.ExtensionBuilder.ExtDirect.readModel(function(result) {
//			var treeData = Ext.create(ExtensionBuilder.Core.aggregateRoot, result);
//			var store = Ext.data.StoreManager.getByKey('ExtensionBuilder.Core.DataStore');
//
//			console.log(treeData.get('text'));
//
//			store.setRootNode(treeData);
////			console.log(store);
////			console.log(treeData);
//		});
	};
	directFn.directCfg = {
		method: {
			len: 0
		}
	};

	var rootNode = Ext.create(ExtensionBuilder.Core.aggregateRoot, {});
	rootNode.set('extKey', 'extensionkey');

//each User hasMany Orders
Ext.regModel('User', {
    fields: ['id', 'name', 'email'],
    proxy : {
        type: 'rest',
        url : '/users',
        reader: 'json'
    },

    hasMany: 'Orders'
});

//each Order belongsTo a User, and hasMany OrderItems
Ext.regModel('Order', {
    fields: ['id', 'user_id', 'status'],
    belongsTo: 'User',
    hasMany: 'OrderItems'
});

//each OrderItem belongsTo an Order
Ext.regModel('OrderItem', {
    fields: ['id', 'order_id', 'name', 'description', 'price', 'quantity'],
    belongsTo: 'Order'
});


//	Ext.regModel('User', {
//
////	Ext.define('User', {
////		extend: 'ExtensionBuilder.Core.Ext.data.Model',
////		labelProperty: 'name',
//		fields: [
//			'id', 'text', 'name', 'email',
//			{name: 'age', type: 'int'},
//			{name: 'gender', type: 'string', defaultValue: 'Unknown'}
//		],
//		hasMany: [
//			{model: 'Address', name: 'addresses'}
//		]
//	});
//
////	Ext.define('Address', {
////		extend: 'ExtensionBuilder.Core.Ext.data.Model',
////		labelProperty: 'firstname',
//	Ext.regModel('Address', {
//		fields: ['id', 'text', 'firstname'],
//		belongsTo: 'User'
//	})

//	rootNode = Ext.create('User', {
	var rootNode = new User(
{
    "id": 123,
    "name": "Aaron Conran",
    "email": "aaron@sencha.com",
    "orders": [
        {
            "id": 1,
            "status": "shipped",
            "orderItems": [
                {
                    "id": 2,
                    "name": "Sencha Touch",
                    "description": "The first HTML5 mobile framework",
                    "price": 0,
                    "quantity": 1
                }
            ]
        }
    ]
}
 );
	
console.log(rootNode);

	ExtensionBuilder.Core.DataStore = Ext.create('Ext.data.TreeStore', {
//		autoLoad: true,
//		autoSync: true,
//		model: ExtensionBuilder.Core.aggregateRoot,
		model: 'User',
//		storeId: 'ExtensionBuilder.Core.DataStore',
//		nodeParam: ['id', 'text'],
		root: {
			expanded: true,
			text: 'test',
			children: [rootNode]
//		},
//		root: Ext.create(ExtensionBuilder.Core.aggregateRoot, {
//			name: 'Test'
//		})
//
//		proxy: {
//			type: 'direct',
//			directFn: directFn
		}
	});


});