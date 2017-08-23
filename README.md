# quickImport
This package used for quick import functionality in php project.


<h1>Prerequisites</h1>
<pre>
For testing existing example follow the steps
</pre>

<pre>


CREATE TABLE `pincodes` (
  `id` bigint(11) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `international_services` varchar(50) NOT NULL,
  `domestic_services` varchar(50) NOT NULL,
  `classification` varchar(50) NOT NULL,
  `is_cod_available` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

</pre>

<pre>
ALTER TABLE `pincodes`
  ADD PRIMARY KEY (`id`);
</pre>

<pre>
ALTER TABLE `pincodes`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
</pre>


<h1>Installation</h1>
<p>Install By composer</p>
<pre>
composer require viotile/quick-import-export
</pre>