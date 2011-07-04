<?php

class Tx_ExtensionBuilder_ExtDirect_CoreProvider {

	/**
	 * @return array
	 */
	public function test() {
		return array('data' => 'test123');
	}

	/**
	 * @return array
	 */
	public function readModel() {

//		return array(
//			array(
//				'extensionKey' => 'test',
//				'name' => 'asdasd',
//				'leaf' => TRUE,
//
//			)
//		);

		$data = array(
			'children' => array(
				'name' => 'Naam van de extensie',
				'extensionDir' => 'dir',
				'extensionKey' => 'ExtKey',
				'domainObjects' => array(
					array(
						'id' => 'tokkie',
						'text' => 'Tokkie'
					)
				),
				'children' => array(
					array(
						'id' => 'node1',
						'text' => 'Node 1',
						'leaf' => FALSE,
						'children' => array(
							array(
								'id' => 'node11',
								'text' => 'Node 1-1',
								'leaf' => TRUE
							),
						)
					),
					array(
						'id' => 'node2',
						'text' => 'Node 2',
						'leaf' => FALSE,
						'children' => array(
							array(
								'id' => 'node21',
								'text' => 'Node 2-1',
								'leaf' => TRUE
							),
						)
					),
					array(
						'id' => 'node3',
						'text' => 'Node 3',
						'leaf' => FALSE,
						'children' => array(
							array(
								'id' => 'node31',
								'text' => 'Node 3-1',
								'leaf' => TRUE
							),
						)
					),
				),
			),
		);
		return $data;
		return array(
			'result' => $data,
			'success' => true,
			'status' => 'success'
		);

//		header('Cache-Control: no-cache, must-revalidate');
//		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
//		header('Content-type: application/json');
//
//		$request = json_decode($HTTP_RAW_POST_DATA);
//
//$request->data = array(
//	(object) array(
//		'id' => 'node1',
//		'text' => 'Node 1',
//		'leaf' => FALSE
//	),
//	(object) array(
//		'id' => 'node2',
//		'text' => 'Node 2',
//		'leaf' => FALSE
//	),
//	(object) array(
//		'id' => 'node3',
//		'text' => 'Node 3',
//		'leaf' => FALSE,
//		'children' => array(
//			(object) array(
//				'id' => 'node31',
//				'text' => 'Node 3-1',
//				'leaf' => TRUE
//			),
//		)
//	),
//);
//		die(json_encode($request));

		die(json_encode(
			(object) array(
				'tid' => 1,
				'action' => 'ExtDirect',
				'method' => 'readModel',
				'type' => 'rpc',
				'result' => array(
					(object) array(
						'id' => 'n12',
						'text' => 'node',
//						'extensionKey' => 'tx_test',
//						'name' => 'hoi',
						'leaf' => FALSE,
					),
					(object) array(
						'id' => 'b23',
						'text' => 'nodes',
//						'extensionKey' => 'tx_test',
//						'name' => 'hoi',
						'leaf' => FALSE,
					)
				)
			)
		));

return array(				(object) array(
					'id' => '12',
					'text' => 'node',
					'extensionKey' => 'tx_test',
					'name' => 'hoi',
					'leaf' => TRUE,
				)
);


		return array($data);

//		die(json_encode($data));
//
//
//		return array(
////			'data' => array(
//				(object) array(
//					'extensionKey' => 'tx_test',
//					'name' => 'hoi',
//					'leaf' => FALSE,
//					'persons' => array(
//						(object) array(
//							'name' => 'Naam',
//							'email' => 'user@domain.com',
//							'leaf' => TRUE
//						)
//					)
////				)
//			),
////			'success' => TRUE
//		);
	}

	/**
	 * @return array
	 * @extdirect
	 */
	public function updateModel() {

	}

	/**
	 * @return array
	 * @extdirect
	 */
	public function deleteModel() {

	}

	/**
	 * @return array
	 * @extdirect
	 */
	public function createModel() {

	}
}

?>