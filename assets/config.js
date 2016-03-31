// Change siteurl value to production url.
var siteurl     = 'http://localhost:8080/billing/index.php/',
    contacturl  = 'http://localhost:8080/billing/index.php/billgenerator/clientcontacts/',
    trantype    = -1,
    accountid   = 0
    contactid   = 0
;

accounting.settings = {
	currency: {
		symbol : "₱ ",   // default currency symbol is '$'
		format: "%s%v", // controls output: %s = symbol, %v = value/number (can be object: see below)
		decimal : ".",  // decimal point separator
		thousand: ",",  // thousands separator
		precision : 2   // decimal places
	},
	number: {
		precision : 0,  // default precision on numbers is 0
		thousand: ",",
		decimal : "."
	}
}