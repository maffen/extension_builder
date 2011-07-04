/**
 * @include EXT:extension_builder/Resources/Public/Library/ext-4.0.2a/ext-all.js
 */
describe('Data modeling test', function() {

	Ext.define('User', {
		extend: 'Ext.data.Model',
		fields: ['id', 'name'],
		associations: [
			{type: 'hasMany', model: 'Order', name: 'orders'}
		]
	});

	Ext.define('Order', {
		extend: 'Ext.data.Model',
		fields: ['id', 'user_id', 'status'],
		belongsTo: 'User',
		associations: [
			{type: 'hasMany', model: 'OrderItem', name: 'orderItems'}
		]
	});

	Ext.define('OrderItem', {
		extend: 'Ext.data.Model',
		fields: ['id', 'order_id', 'name'],
		belongsTo: 'Order'
	});

	var user1;

	var user2;

	beforeEach (function() {

		user1 = Ext.create('User', {
			id: 123,
			name: 'John Doe',
			orders: [{
				id: 1,
				status: 'shipped',
				orderItems: [
					{ id: 2, name: 'Product 3' }
				]
			}, {
				id: 2,
				status: 'new',
				orderItems: [
					{ id: 23, name: 'Product 1' },
					{ id: 5, name: 'Product 2' }
				]
			}]
		});

		user2 = Ext.create('User', {
			id: 123,
			name: 'John Doe'
		});

		var order1 = Ext.create('Order', {id: 1, status: 'shipped'});
		order1.orderItems().add({ id: 2, name: 'Product 3' });
		user2.orders().add(order1);

		var order2 = Ext.create('Order', {id: 2, status: 'new'});
		order2.orderItems().add({ id: 23, name: 'Product 1' });
		order2.orderItems().add({ id: 5, name: 'Product 2' });
		user2.orders().add(order2);
	});

	it ('Test model initialization', function() {
		expect(user1.get('id')).toEqual(123);

		var orders = user2.orders();

		console.log(user2, orders, orders.getAt(0));

//		expect(user.orders()[0].get('id')).toEqual(1);
	});

});