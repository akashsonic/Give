<?php

/**
 * @group formatting
 */
class Tests_MISC_Functions extends Give_Unit_Test_Case {
	public function setUp() {
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
	}


	/**
	 * test for give_get_currency_name
	 *
	 * @since         1.8.8
	 * @access        public
	 *
	 * @param string $value
	 * @param string $expected
	 *
	 * @cover         give_get_currency_name
	 * @dataProvider  give_get_currency_name_data_provider
	 */
	public function test_give_get_currency_name( $value, $expected ) {
		$this->assertEquals( $expected, $value );
	}


	/**
	 * Data Provider.
	 *
	 * @since 1.8.8
	 * @return array
	 */
	public function give_get_currency_name_data_provider() {
		return array(
			array( give_get_currency_name( 'USD' ), __( 'US Dollars', 'give' ) ),
			array( give_get_currency_name( 'EUR' ), __( 'Euros', 'give' ) ),
			array( give_get_currency_name( 'GBP' ), __( 'Pounds Sterling', 'give' ) ),
			array( give_get_currency_name( 'AUD' ), __( 'Australian Dollars', 'give' ) ),
			array( give_get_currency_name( 'BRL' ), __( 'Brazilian Real', 'give' ) ),
			array( give_get_currency_name( 'CAD' ), __( 'Canadian Dollars', 'give' ) ),
			array( give_get_currency_name( 'CZK' ), __( 'Czech Koruna', 'give' ) ),
			array( give_get_currency_name( 'DKK' ), __( 'Danish Krone', 'give' ) ),
			array( give_get_currency_name( 'HKD' ), __( 'Hong Kong Dollar', 'give' ) ),
			array( give_get_currency_name( 'HUF' ), __( 'Hungarian Forint', 'give' ) ),
			array( give_get_currency_name( 'ILS' ), __( 'Israeli Shekel', 'give' ) ),
			array( give_get_currency_name( 'JPY' ), __( 'Japanese Yen', 'give' ) ),
			array( give_get_currency_name( 'MYR' ), __( 'Malaysian Ringgits', 'give' ) ),
			array( give_get_currency_name( 'MXN' ), __( 'Mexican Peso', 'give' ) ),
			array( give_get_currency_name( 'MAD' ), __( 'Moroccan Dirham', 'give' ) ),
			array( give_get_currency_name( 'NZD' ), __( 'New Zealand Dollar', 'give' ) ),
			array( give_get_currency_name( 'NOK' ), __( 'Norwegian Krone', 'give' ) ),
			array( give_get_currency_name( 'PHP' ), __( 'Philippine Pesos', 'give' ) ),
			array( give_get_currency_name( 'PLN' ), __( 'Polish Zloty', 'give' ) ),
			array( give_get_currency_name( 'SGD' ), __( 'Singapore Dollar', 'give' ) ),
			array( give_get_currency_name( 'KRW' ), __( 'South Korean Won', 'give' ) ),
			array( give_get_currency_name( 'ZAR' ), __( 'South African Rand', 'give' ) ),
			array( give_get_currency_name( 'SEK' ), __( 'Swedish Krona', 'give' ) ),
			array( give_get_currency_name( 'CHF' ), __( 'Swiss Franc', 'give' ) ),
			array( give_get_currency_name( 'TWD' ), __( 'Taiwan New Dollars', 'give' ) ),
			array( give_get_currency_name( 'THB' ), __( 'Thai Baht', 'give' ) ),
			array( give_get_currency_name( 'INR' ), __( 'Indian Rupee', 'give' ) ),
			array( give_get_currency_name( 'TRY' ), __( 'Turkish Lira', 'give' ) ),
			array( give_get_currency_name( 'IRR' ), __( 'Iranian Rial', 'give' ) ),
			array( give_get_currency_name( 'RUB' ), __( 'Russian Rubles', 'give' ) ),
			array( give_get_currency_name( 'Wrong_Currency_Symbol' ), '' ),
		);
	}

	/**
	 * test for give post type meta related functions
	 *
	 * @since         1.8.8
	 * @access        public
	 *
	 * @cover         give_get_meta
	 * @cover         give_update_meta
	 * @cover         give_delete_meta
	 */
	public function test_give_meta_helpers() {
		$payment = Give_Helper_Payment::create_simple_payment();

		$value = give_get_meta( $payment, 'testing_meta', true, 'TEST1' );
		$this->assertEquals( 'TEST1', $value );

		$status = give_update_meta( $payment, 'testing_meta', 'TEST' );
		$this->assertEquals( true, (bool) $status );

		$status = give_update_meta( $payment, 'testing_meta', 'TEST' );
		$this->assertEquals( false, (bool) $status );

		$value = give_get_meta( $payment, 'testing_meta', true );
		$this->assertEquals( 'TEST', $value );

		$status = give_delete_meta( $payment, 'testing_meta', 'TEST2' );
		$this->assertEquals( false, $status );

		$status = give_delete_meta( $payment, 'testing_meta' );
		$this->assertEquals( true, $status );
	}

	/**
	 * Test for building Item Title of Payment Gateway.
	 *
	 * @since 1.8.14
	 * @access public
	 *
	 * @cover give_payment_gateway_item_title
	 */
	public function test_give_payment_gateway_item_title() {

		// Setup Simple Donation Form.
		$donation = Give_Helper_Form::setup_simple_donation_form();

		// Simple Donation Form using Payment Gateway Item Title.
		$title = give_payment_gateway_item_title( $donation );
		$this->assertEquals( 'Test Donation Form', $title );

		// Setup Simple Donation Form with Custom Amount.
		$donation = Give_Helper_Form::setup_simple_donation_form( true );

		// Simple Donation Form using Payment Gateway Item Title with Custom Amount.
		$title = give_payment_gateway_item_title( $donation );
		$this->assertEquals( 'Test Donation Form', $title );

		// Setup MultiLevel Donation Form.
		$donation = Give_Helper_Form::setup_multi_level_donation_form();

		// MultiLevel Donation Form using Payment Gateway Item Title.
		$title = give_payment_gateway_item_title( $donation );
		$this->assertEquals( 'Test Donation Form - Mid-size Gift', $title );

		// Setup MultiLevel Donation Form with Custom Amount.
		$donation = Give_Helper_Form::setup_multi_level_donation_form( true );

		// MultiLevel Donation Form using Payment Gateway Item Title with Custom Amount.
		$title = give_payment_gateway_item_title( $donation );
		$this->assertEquals( 'Test Donation Form', $title );

	}
}
