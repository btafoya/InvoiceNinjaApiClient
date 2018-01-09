# Troubleshooting

### Turn on verbose mode

```php
$InvoiceNinjaApiClient = new InvoiceNinjaApiClient("http://invoiceninjaurl", "apitoken");
$InvoiceNinjaApiClient->verbose();
$InvoiceNinjaApiClient->getProducts();
var_dump($InvoiceNinjaApiClient);
```
