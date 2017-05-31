<?php

class ProductsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('products')->delete();
        
		\DB::table('products')->insert(array (
			0 => 
			array (
				'id' => 127,
				'name' => 'Angie Banner Stand',
				'short_name' => 'angie-banner-stand',
				'sku' => '2bf77dda-ed6c-3112-9810-2800916135e1',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Our best-selling retractable banner stand!',
				'description' => '<strong>&ldquo;Click&rdquo; Feature</strong> &ndash; Angie is an open cassette system and by pushing the buttons on the side-caps, the graphic or even the entire roller can be replaced.<br />
<br />
<strong>Stability</strong> &ndash; This banner stand has an extra wide base design and adjustable feet that allow it to stand up straight and tall even on uneven surfaces.',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">brilliant full-color graphic included</li>
<li style="padding: 0px; margin: 0px;">easy to set-up and take-down</li>
<li style="padding: 0px; margin: 0px;">wide base for stability</li>
<li style="padding: 0px; margin: 0px;">adjustable feet for uneven floors</li>
<li style="padding: 0px; margin: 0px;">includes a deluxe padded case</li>
<li style="padding: 0px; margin: 0px;">easy-to-change graphics (additional interchangeable graphics cartridge)</li>
<li style="padding: 0px; margin: 0px;">optional halogen light available</li>
</ul>
',
				'technical' => '&nbsp;
<table style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal; text-align: center;" width="300">
<tbody style="padding: 0px; margin: 0px;">
<tr style="padding: 0px; margin: 0px; font-weight: bolder; background-color: rgb(204, 204, 204);">
<td style="padding: 0px; margin: 0px;">Product Code</td>
<td style="padding: 0px; margin: 0px;">Graphic Size</td>
<td style="padding: 0px; margin: 0px;">Weight</td>
</tr>
<tr style="padding: 0px; margin: 0px; background-color: rgb(230, 231, 232);">
<td style="padding: 0px; margin: 0px; font-weight: bolder;">BA-600</td>
<td style="padding: 0px; margin: 0px;">23.5&quot;w x 70&quot;h</td>
<td style="padding: 0px; margin: 0px;">10lbs</td>
</tr>
<tr style="padding: 0px; margin: 0px; background-color: rgb(230, 231, 232);">
<td style="padding: 0px; margin: 0px; font-weight: bolder;">BA-850</td>
<td style="padding: 0px; margin: 0px;">33.5&quot;w x 85&quot;h</td>
<td style="padding: 0px; margin: 0px;">13lbs</td>
</tr>
<tr style="padding: 0px; margin: 0px; background-color: rgb(230, 231, 232);">
<td style="padding: 0px; margin: 0px; font-weight: bolder;">BA-1000</td>
<td style="padding: 0px; margin: 0px;">39&quot;w x 85&quot;h</td>
<td style="padding: 0px; margin: 0px;">15lbs</td>
</tr>
<tr style="padding: 0px; margin: 0px; background-color: rgb(230, 231, 232);">
<td style="padding: 0px; margin: 0px; font-weight: bolder;">BA-1200</td>
<td style="padding: 0px; margin: 0px;">47.24&quot;w x 85&quot;h</td>
<td style="padding: 0px; margin: 0px;">16lbs</td>
</tr>
<tr style="padding: 0px; margin: 0px; background-color: rgb(230, 231, 232);">
<td style="padding: 0px; margin: 0px; font-weight: bolder;">BA-1500</td>
<td style="padding: 0px; margin: 0px;">59.05&quot;w x 85&quot;h</td>
<td style="padding: 0px; margin: 0px;">18lbs</td>
</tr>
</tbody>
</table>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;<img alt="" height="190" src="http://anvydigital.com/upload/UserFiles/image/Supreme-set-up.png" style="padding: 0px; margin: 0px;" width="500" /></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;</p>
<a href="http://anvydigital.com/images/manual/ArtworkPrep-Angie.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Dimensions: Angie Banner Stand</a>

<div style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;</div>
<a href="http://anvydigital.com/images/manual/ArtworkPreparationGuide.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Artwork Preparation Guide</a>',
				'meta_title' => '',
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-banner-stands',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-23 22:15:56',
			),
			1 => 
			array (
				'id' => 128,
				'name' => 'Iris Banner Stand',
				'short_name' => 'iris-banner-stand',
				'sku' => '7abea86c-cc03-3ca7-ac04-13839a5527a2',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Our top-of-the-line retractable banner stand!',
				'description' => '<strong>&ldquo;Two Click&rdquo; Feature</strong> &ndash; By simply pushing buttons on both sides, Iris can be opened and changing the graphic could not be any easier.<br />
<br />
<strong>Tension Adjustment Device</strong> &ndash;No Losing tension on Iris! Tension can be easily restored by turning this device on the side-cap.<br />
<br />
<strong>Locking Device</strong> &ndash; This is a built-in device. A simple push and turn can lock the roller into place.<br />
<br />
<strong>Stability &amp; Adaptability</strong> &ndash; The metal case has adjustable feet making this case extremely sturdy even on the most uneven surface.',
				'specification' => '<br />
<br />
<strong>Features</strong>
<ul>
<li>Brilliant full-color graphic included</li>
<li>Easy to set-up and take-down</li>
<li>Telescopic Pole for variable height banners ( 4ft to 7ft)</li>
<li>Tension adjustment mechanism</li>
<li>Includes a deluxe padded case</li>
<li>Easy-to-change graphics&nbsp;with additional interchangeable cartridge</li>
<li>Optional halogen light available</li>
</ul>
',
				'technical' => '&nbsp;
<table style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal; text-align: center;" width="450">
<tbody style="padding: 0px; margin: 0px;">
<tr style="padding: 0px; margin: 0px; font-weight: bolder; background-color: rgb(204, 204, 204);">
<td style="padding: 0px; margin: 0px;">Product Code</td>
<td style="padding: 0px; margin: 0px;">Graphic Size</td>
<td style="padding: 0px; margin: 0px;">Weight</td>
<td style="padding: 0px; margin: 0px;">Packaging</td>
</tr>
<tr style="padding: 0px; margin: 0px; background-color: rgb(230, 231, 232);">
<td style="padding: 0px; margin: 0px; font-weight: bolder;">BI-850</td>
<td style="padding: 0px; margin: 0px;">33.5&quot;w x 85&quot;h</td>
<td style="padding: 0px; margin: 0px;">14lbs</td>
<td style="padding: 0px; margin: 0px;">Deluxe Carrying Case</td>
</tr>
</tbody>
</table>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><img alt="" height="190" src="http://anvydigital.com/upload/UserFiles/image/Supreme-set-up.png" style="padding: 0px; margin: 0px;" width="500" /></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;</p>
<a href="http://anvydigital.com/images/manual/ArtworkPrep-Iris.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Dimensions: Iris Banner Stand</a>

<div style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;</div>
<a href="http://anvydigital.com/images/manual/ArtworkPreparationGuide.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Artwork Preparation Guide</a>',
				'meta_title' => 'Iris Banner Stand',
				'meta_description' => 'Our top-of-the-line retractable banner stand!',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-banner-stands',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 11:53:24',
			),
			2 => 
			array (
				'id' => 129,
				'name' => 'Kimmi Banner Stand',
				'short_name' => 'kimmi-banner-stand',
				'sku' => '807df3bf-7a21-32db-be06-39161a270dc1',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Our double-sided retractable banner stand.',
				'description' => '<strong>Double the Outcome</strong>- Kimmi is the double-sided version of our top selling Angie Model. With a double-sided feature, your message / graphic will receive double the amount of attention.<br />
<br />
<strong>&ldquo;Click&rdquo; Feature</strong> - Kimmi is an open cassette system and by pushing the buttons on the side-caps, the graphic or even the entire roller can be replaced.',
			'specification' => '<div style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<strong style="padding: 0px; margin: 0px;">Features</strong></div>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">Brilliant full-colour graphic included</li>
<li style="padding: 0px; margin: 0px;">Easy to set-up and take-down</li>
<li style="padding: 0px; margin: 0px;">Wide base for stability</li>
<li style="padding: 0px; margin: 0px;">Adjustable feet for uneven floors</li>
<li style="padding: 0px; margin: 0px;">Includes a deluxe padded case</li>
<li style="padding: 0px; margin: 0px;">Easy-to-change graphics&nbsp;<span style="line-height: 20.7999992370605px;">(with additional interchangeable cartridge)</span></li>
</ul>
',
				'technical' => '<br />
<table style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal; text-align: center;" width="450">
<tbody style="padding: 0px; margin: 0px;">
<tr style="padding: 0px; margin: 0px; font-weight: bolder; background-color: rgb(204, 204, 204);">
<td style="padding: 0px; margin: 0px;">Product Code</td>
<td style="padding: 0px; margin: 0px;">Graphic Size</td>
<td style="padding: 0px; margin: 0px;">Weight</td>
<td style="padding: 0px; margin: 0px;">Packaging</td>
</tr>
<tr style="padding: 0px; margin: 0px; background-color: rgb(230, 231, 232);">
<td style="padding: 0px; margin: 0px; font-weight: bolder;">BK-850</td>
<td style="padding: 0px; margin: 0px;">33.5&quot;w x 85&quot;h</td>
<td style="padding: 0px; margin: 0px;">21lbs</td>
<td style="padding: 0px; margin: 0px;">Deluxe Carrying Case</td>
</tr>
<tr style="padding: 0px; margin: 0px; background-color: rgb(230, 231, 232);">
<td style="padding: 0px; margin: 0px; font-weight: bolder;">BK-1000</td>
<td style="padding: 0px; margin: 0px;">39&quot;w x 85&quot;h</td>
<td style="padding: 0px; margin: 0px;">22lbs</td>
<td style="padding: 0px; margin: 0px;">Deluxe Carrying Case</td>
</tr>
</tbody>
</table>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><img alt="" height="219" src="http://anvydigital.com/upload/UserFiles/image/Dual-set-up.png" style="padding: 0px; margin: 0px;" width="500" /></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;</p>
<a href="http://anvydigital.com/images/manual/ArtworkPrep-Kimmi.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Dimensions: Kimmi Banner Stand</a>

<div style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;</div>
<a href="http://anvydigital.com/images/manual/ArtworkPreparationGuide.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Artwork Preparation Guide</a>',
				'meta_title' => 'Kimmi Banner Stand',
				'meta_description' => 'Our double-sided retractable banner stand.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-banner-stands/',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 12:10:21',
			),
			3 => 
			array (
				'id' => 130,
				'name' => 'Jenni Banner Stand',
				'short_name' => 'jenni-banner-stand',
				'sku' => '17ef8370-379b-3a18-9de1-2372ba384196',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'A lightweight banner stand.',
				'description' => '<p><strong>Double &nbsp;Outcome</strong> - A rare but perfect mixture of practicality and durability<br />
<br />
<strong>Stability</strong> - Dual twist out stabilizing feet for more stability.&nbsp;<br />
<br />
<strong>Simplicity</strong> - Fast and easy to set up .</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">Brilliant full-color graphic included</li>
<li style="padding: 0px; margin: 0px;">Easy to set-up and take-down</li>
<li style="padding: 0px; margin: 0px;">Dual twist out feet for extra stabilization</li>
<li style="padding: 0px; margin: 0px;">Includes a deluxe padded case</li>
<li style="padding: 0px; margin: 0px;">Easy-to-change graphics with additional interchangeable cartridge</li>
<li style="padding: 0px; margin: 0px;">Optional halogen banner light available</li>
</ul>
',
				'technical' => '<br />
<table style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal; text-align: center;" width="450">
<tbody style="padding: 0px; margin: 0px;">
<tr style="padding: 0px; margin: 0px; font-weight: bolder; background-color: rgb(204, 204, 204);">
<td style="padding: 0px; margin: 0px;">Product Code</td>
<td style="padding: 0px; margin: 0px;">Graphic Size</td>
<td style="padding: 0px; margin: 0px;">Weight</td>
<td style="padding: 0px; margin: 0px;">Packaging</td>
</tr>
<tr style="padding: 0px; margin: 0px; background-color: rgb(230, 231, 232);">
<td style="padding: 0px; margin: 0px; font-weight: bolder;">BJ-850</td>
<td style="padding: 0px; margin: 0px;">33.5&quot;w x 85&quot;h</td>
<td style="padding: 0px; margin: 0px;">9lbs</td>
<td style="padding: 0px; margin: 0px;">Deluxe Carrying Case</td>
</tr>
</tbody>
</table>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><img alt="" height="190" src="http://anvydigital.com/upload/UserFiles/image/Supreme-set-up.png" style="padding: 0px; margin: 0px;" width="500" /></p>
<a href="http://anvydigital.com/images/manual/jenni-info-packet.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Download a Jenni information packet</a><br style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;" />
<a href="http://anvydigital.com/images/manual/jenni.indd" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Download an InDesign template file</a>

<div style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;</div>
<a href="http://anvydigital.com/images/manual/ArtworkPreparationGuide.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">General Artwork Preparation Guide</a>',
				'meta_title' => 'Jenni Banner Stand',
				'meta_description' => 'A lightweight banner stand.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-banner-stands',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 11:57:31',
			),
			4 => 
			array (
				'id' => 131,
				'name' => 'Lily Banner Stand',
				'short_name' => 'lily-banner-stand',
				'sku' => '1d2eb89b-59a0-3c57-bba1-3084612379e6',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'An elegant non-retractable stand.',
				'description' => '<strong>Simplicity with Performance</strong> - This banner stand offers a stylish presentation with an outstanding performance.<br />
<br />
<strong>Stability</strong> &ndash; The lightweight allow feet combined with the weighted pole create outstanding stability.<br />
<br />
<strong>Flexiblity</strong> - With an adjustable Hybrid Telescopic Pole, you can adjust the graphics height or link the systems to create an impressive graphic wall.',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">Brilliant full-color graphic included</li>
<li style="padding: 0px; margin: 0px;">Lightweight</li>
<li style="padding: 0px; margin: 0px;">Value-priced</li>
<li style="padding: 0px; margin: 0px;">Easily interchangeable graphics</li>
<li style="padding: 0px; margin: 0px;">Optional halogen banner light available</li>
</ul>
',
				'technical' => '<br />
<br />
&nbsp;
<table style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal; text-align: center;" width="450">
<tbody style="padding: 0px; margin: 0px;">
<tr style="padding: 0px; margin: 0px; font-weight: bolder; background-color: rgb(204, 204, 204);">
<td style="padding: 0px; margin: 0px;">Product Code</td>
<td style="padding: 0px; margin: 0px;">Graphic Size</td>
<td style="padding: 0px; margin: 0px;">Weight</td>
<td style="padding: 0px; margin: 0px;">Packaging</td>
</tr>
<tr style="padding: 0px; margin: 0px; background-color: rgb(230, 231, 232);">
<td style="padding: 0px; margin: 0px; font-weight: bolder;">BL-850</td>
<td style="padding: 0px; margin: 0px;">33.5&quot;w x 85&quot;h</td>
<td style="padding: 0px; margin: 0px;">9lbs</td>
<td style="padding: 0px; margin: 0px;">Carrying Case</td>
</tr>
</tbody>
</table>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><img alt="" height="195" src="http://anvydigital.com/upload/UserFiles/image/Lite-set-up.png" style="padding: 0px; margin: 0px;" width="500" /></p>
<a href="http://anvydigital.com/images/manual/ArtworkPrep-Lily.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Dimensions: Lily Banner Stand</a>

<div style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;</div>
<a href="http://anvydigital.com/images/manual/ArtworkPreparationGuide.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Artwork Preparation Guide</a>',
				'meta_title' => 'Lily Banner Stand',
				'meta_description' => 'An elegant non-retractable stand.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-banner-stands',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 13:46:37',
			),
			5 => 
			array (
				'id' => 132,
				'name' => 'Tia Banner Stand',
				'short_name' => 'tia-banner-stand',
				'sku' => 'e88f42b4-76b5-3bb6-82a7-58a8c798f08d',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'A sturdy non-retractable banner stand.',
				'description' => '<strong>Simplicity with Performance</strong> - Lightweight and easy to use with outstanding performance.<br />
<br />
<strong>Optional</strong> - Single or an optional double sided display with an additional interchangeable graphics cartridge',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">Elegant tensioned banner stand featuring an integral tripod foot</li>
<li style="padding: 0px; margin: 0px;">Integrated tripod forms a stable base</li>
<li style="padding: 0px; margin: 0px;">Hanging image ensures your message stays at eye-level</li>
<li style="padding: 0px; margin: 0px;">Single or optional double-sided display
<p style="padding: 0px; margin: 0px 0px 1em;">with additional interchangeable graphics cartridge</p>
</li>
</ul>
',
				'technical' => '<br />
<table style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal; text-align: center;" width="450">
<tbody style="padding: 0px; margin: 0px;">
<tr style="padding: 0px; margin: 0px; font-weight: bolder; background-color: rgb(204, 204, 204);">
<td style="padding: 0px; margin: 0px;">Product Code</td>
<td style="padding: 0px; margin: 0px;">Graphic Size</td>
<td style="padding: 0px; margin: 0px;">Weight</td>
<td style="padding: 0px; margin: 0px;">Packaging</td>
</tr>
<tr style="padding: 0px; margin: 0px; background-color: rgb(230, 231, 232);">
<td style="padding: 0px; margin: 0px; font-weight: bolder;">BT-800</td>
<td style="padding: 0px; margin: 0px;">31.5&quot;w x 85&quot;h</td>
<td style="padding: 0px; margin: 0px;">10lbs</td>
<td style="padding: 0px; margin: 0px;">Carrying Case</td>
</tr>
</tbody>
</table>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><img alt="" height="223" src="http://anvydigital.com/upload/UserFiles/image/triosetup.png" style="padding: 0px; margin: 0px;" width="500" /></p>
<a href="http://anvydigital.com/images/manual/ArtworkPrep-Tia.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Dimensions:Tia Banner Stand</a>

<div style="padding: 0px; margin: 0px;"><a href="http://anvydigital.com/images/manual/ArtworkPrep-Tia.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;</a></div>
<a href="http://anvydigital.com/images/manual/ArtworkPreparationGuide.pdf" style="padding: 0px; margin: 0px; text-decoration: none; color: rgb(150, 150, 150); font-weight: bold; outline: none; border: none; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Artwork Preparation Guide</a>',
				'meta_title' => 'Tia Banner Stand',
				'meta_description' => 'A sturdy non-retractable banner stand.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-banner-stands',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 15:27:16',
			),
			6 => 
			array (
				'id' => 133,
				'name' => 'Pop-Up Display',
				'short_name' => 'pop-up-display',
				'sku' => 'fd42dbcc-08c1-34fe-a145-5055d348dbad',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Pop-up booth displays are the easiest and fastest way to show off your business at your next trade show.',
				'description' => '<p style="text-align: justify;">Easy to assemble and take-down, these magnet-mounted panels are built for durability, flexibility and longevity. It sets up and folds down in a matter of seconds to a compact size and requires only one person to do so. The Pop Up Display offers maximum impact with minimum effort for your display.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal; width: 350px;" type="disc">
<li style="padding: 0px; margin: 0px;">Self-locking technology</li>
<li style="padding: 0px; margin: 0px;">Cross-bracing throughout for superior stability</li>
<li style="padding: 0px; margin: 0px;">Tempered steel-on-steel hubs ensure maximum strength at all critical, high stress joints</li>
<li style="padding: 0px; margin: 0px;">Polar opposite magnet-to-magnet mounting ensures panels self-align with seamless precision</li>
<li style="padding: 0px; margin: 0px;">Printed and laminated styrene is durable and long-lasting</li>
<li style="padding: 0px; margin: 0px;">Folds down to a compactible and portable size</li>
<li style="padding: 0px; margin: 0px;">Requires only one person to set up</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Sizes Available</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Available in 8&rsquo; and 10&rsquo; lengths, these 90&rdquo; high displays come with three to four magnet- or Velcro-mounted laminated panels that can be switched out and replaced with an alternate panel.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Custom sizes available that suites your needs</p>
',
				'meta_title' => 'Pop-Up Display',
				'meta_description' => 'Pop-up booth displays are the easiest and fastest way to show off your business at your next trade show.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => '',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 14:41:36',
			),
			7 => 
			array (
				'id' => 134,
				'name' => 'Milan Fabric Display',
				'short_name' => 'milan-fabric-display',
				'sku' => '98226abf-cb75-3256-a0a5-0577507c57e8',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => '',
				'description' => '<p>The &ldquo;Milan,&rdquo; a lightweight, display stand.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">Compact and lightweight</li>
<li style="padding: 0px; margin: 0px;">Easy to transport, ship and store</li>
<li style="padding: 0px; margin: 0px;">Additional printed graphics can be switched out in seconds</li>
</ul>

<div class="clr" style="padding: 0px; margin: 0px; clear: both; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; height: 0px !important; line-height: 0px !important;">&nbsp;</div>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Sizes Available</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: 0px;">Custom sizes are available to suite your needs<br />
<br />
<br />
<br />
&nbsp;</p>
<br />
<br />
<br />
<br />
Talk to your Anvy Digital representative for additional details about available accessories.',
				'technical' => '',
				'meta_title' => '',
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => '',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 14:36:03',
			),
			8 => 
			array (
				'id' => 135,
				'name' => 'Tablet Stand',
				'short_name' => 'tablet-stand',
				'sku' => '9e501ff0-1bcf-32a0-9589-d42c4d2b2449',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Our Popular Tablet holders.',
				'description' => '<p>Add an element of customer interaction at your next showcase or display with a tablet stand. Tablets are a great way to give your customers more information in your product.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">Rotates from Portrait to Landscape</li>
<li style="padding: 0px; margin: 0px;">Anti-Theft Hardware</li>
<li style="padding: 0px; margin: 0px;">Metal Back, Uprights &amp; Bases</li>
<li style="padding: 0px; margin: 0px;">High Impact Acrylic Cover</li>
<li style="padding: 0px; margin: 0px;">Included USB cable runs from top</li>
<li style="padding: 0px; margin: 0px;">Available in Matte Black or Satin Silver finish</li>
<li style="padding: 0px; margin: 0px;">Hide cables through the stand</li>
</ul>
',
				'technical' => '<br />
<br />
<br />
<span style="color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">It is now compatible with the Samsung Galaxy 10.1, and Ipad. Available in freestanding, counter top, and wall mount configurations, these tablet holders work to create an interactive element in your booth. Impress attendees with an informative slideshow or attract attention with an interactive demo, the possibilities are endless.</span>',
				'meta_title' => 'Tablet Stand',
				'meta_description' => 'Our Popular Tablet holders.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-tablet-stand/',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 15:24:01',
			),
			9 => 
			array (
				'id' => 136,
				'name' => 'Tablet Stand with Graphic',
				'short_name' => 'tablet-stand-with-graphic',
				'sku' => '4722386d-0a26-3a21-8c36-8f3c57a3c441',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			10 => 
			array (
				'id' => 137,
				'name' => 'Smart Digital Signage',
				'short_name' => 'smart-digital-signage',
				'sku' => '050e6a8c-5c7c-322e-ad3c-114c239c1144',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
			'description' => '<p><span style="color: rgb(128, 128, 128);">Smart Digital Signage is the display of dynamic content to your customers using TVs and monitors to advertise your message.</span></p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => 'Anvy Digital creates custom Interactive Digital Signage for all companies.  We are template free and build custom solutions for clients right across North America.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			11 => 
			array (
				'id' => 138,
				'name' => 'Smart Mobile Development',
				'short_name' => 'smart-mobile-development',
				'sku' => 'd6809141-14eb-3a80-918f-5e5e5ff66a44',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
			'description' => '<p><span style="color: rgb(128, 128, 128);">Anvy Digital prides itself on being a one-stop solution for their customers.</span></p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			12 => 
			array (
				'id' => 139,
				'name' => 'Vinyl Banner',
				'short_name' => 'vinyl-banner',
				'sku' => '407ba068-749e-3018-9fa9-6d629cd52096',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'One of the most popular and most cost-effective promotional tools.',
				'description' => '<p style="text-align: justify;">Digitally printed vinyl banners are a proven approach to attracting attention. Vinyl banners can be hung just about anywhere! If you want to promote your image, products, services, or simply want to make a statement, banners are quick and ideal solution. They can be easily taken down and stored away for later use.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<br />
<strong style="padding: 0px; margin: 0px;">Specifications</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">13 oz polyester with PVC coating</li>
<li style="padding: 0px; margin: 0px;">Tear, puncture and fade resistant</li>
<li style="padding: 0px; margin: 0px;">Fungus and mildew resistant</li>
<li style="padding: 0px; margin: 0px;">Economical</li>
</ul>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Features &amp; Options</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">Matte or gloss finish</li>
<li style="padding: 0px; margin: 0px;">Stretch-free for long-term mechanical stability</li>
<li style="padding: 0px; margin: 0px;">Repels pollution and washes clean in water</li>
<li style="padding: 0px; margin: 0px;">Heat welding allows for any size graphic</li>
<li style="padding: 0px; margin: 0px;">High quality, full-color, digital printing</li>
<li style="padding: 0px; margin: 0px;">Bright white background</li>
<li style="padding: 0px; margin: 0px;">Accurate color matching</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Vinyl banners</strong><br />
<br />
Finishing can include seamed edging, grommets or pole pockets, and of course, we always use the highest quality materials and processes available.</p>
',
				'meta_title' => 'Vinyl Banner',
				'meta_description' => 'One of the most popular and most cost-effective promotional tools.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-vinyl-banner',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 15:43:45',
			),
			13 => 
			array (
				'id' => 140,
				'name' => 'Mesh Banner',
				'short_name' => 'mesh-banner',
				'sku' => '1656562c-c0ec-34c6-a13a-dce52a26c286',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Anvy&rsquo;s mesh banners are the solution.',
				'description' => '<p style="text-align: justify;">Mother Nature is a force to reckon with, so if your banner must deal with wind and strong air currents, Anvy&rsquo;s mesh banners are the solution. The perforation of the material allows wind to pass through the banner so it doesn&rsquo;t blow away. The graphic is printed directly to the white mesh, accepting each and every colour beautifully. &nbsp;This banner is waterproof so no need to worry about the outside elements!</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Features &amp; Options</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">Stretch-free for long-term stability</li>
<li style="padding: 0px; margin: 0px;">Hems and grommets</li>
<li style="padding: 0px; margin: 0px;">Rod pockets and doweling</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Sizes Available</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">One piece graphics available in custom lengths up to 72&quot; wide. Stitching together allows for any size graphic.</p>
',
				'meta_title' => 'Mesh Banner',
				'meta_description' => 'Anvy&rsquo;s mesh banners are the solution.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => '',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 14:03:06',
			),
			14 => 
			array (
				'id' => 141,
				'name' => 'Acrylic Prints',
				'short_name' => 'acrylic-prints',
				'sku' => 'a1f3ef06-7079-3002-8d08-5ebcca0dbe3b',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Direct print to acrylic boards for displaying signage, photography or graphics.',
				'description' => 'Acrylic prints are a contemporary way of printing and displaying photography, artwork, signage, marketing messages or any other image on an impressive wall hanging print.<br />
<br />
We offer any size, any thickness, optional contour cut to shape and many hanging accessories to make this direct print to Plexiglass a piece of art.<br />
<br />
We can also reverse print our graphics onto the acrylic to avoid wear and tear on the graphic. This means the graphic is printed on the underside so that the graphic can&rsquo;t be scratched off.',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">Available in clear, white, black, blue, &amp; pink stocks</li>
<li style="padding: 0px; margin: 0px;">Choice of satin silver, polished chrome, or anodized black standoffs</li>
<li style="padding: 0px; margin: 0px;">Superior High Definition direct printing (not laminated)</li>
<li style="padding: 0px; margin: 0px;">Flamed polished edges and superb glossy finish look</li>
<li style="padding: 0px; margin: 0px;">Continuous print up to a 5&prime; x 10&prime; size</li>
<li style="padding: 0px; margin: 0px;">Water- and fade-resistant</li>
<li style="padding: 0px; margin: 0px;">Durable for both Indoor and outdoor</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Why Acrylic Photo?</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Displaying your photos on acrylic is a spectacular experience. The moment you see your photo displayed on Acrylic Photo you&rsquo;re greeted by glorious luminance through the stunning glossy surface. But that&rsquo;s only one gleaming quality of Acrylic Photo from Anvy Digital. With our state&ndash;of&ndash;the&ndash;art direct print process, the picture is brilliant and sharp from edge to edge, and with a number of finishing options you can customize it just the way you want it.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Precision engineered. Beautifully made. You&rsquo;ll immediately notice the difference. Choose Acrylic Photo from Anvy Digital and we&rsquo;ll turn your photos into beautiful and captivating art pieces for your home or business.</p>

<div style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal; width: 350px; float: left;"><strong style="padding: 0px; margin: 0px;">Different Standoff Options</strong>

<p style="padding: 0px; margin: 1em 0px;">&nbsp;<img alt="" src="/assets/images/editor/standoff(1).jpg" style="padding: 0px; margin: 0px; width: 300px; height: 168px;" /></p>
</div>

<div style="padding: 0px; margin: -12px 0px 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal; width: 350px; float: right;">
<p style="padding: 0px; margin: 1em 0px;"><strong style="padding: 0px; margin: 0px;">Different Product Option</strong></p>

<p style="padding: 0px; margin: 1em 0px;"><img alt="" image="" src="/assets/images/editor/acrylic1.jpg" style="padding: 0px; margin: 0px; width: 100px; height: 100px;" userfiles="" /><img alt="" src="/assets/images/editor/fs15v_wall_set_signage_glass.jpg" style="padding: 0px; margin: 0px; width: 100px; height: 100px;" /><img alt="" src="/assets/images/editor/DSC_0547-edited.jpg" style="padding: 0px; margin: 0px; width: 100px; height: 67px;" /></p>
</div>

<div class="clr" style="padding: 0px; margin: 0px; clear: both; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; height: 0px !important; line-height: 0px !important;">&nbsp;</div>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">We offer different standoff sizes, standoff colour and style/layout options to suit your needs!</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Please call us for more inspirations!!!</p>
',
				'meta_title' => '',
				'meta_description' => 'Acrylic prints are a contemporary way of printing and displaying photography, artwork, signage, marketing messages or any other image on an impressive wall hanging print. Acrylic prints can either be produced from one of your photos/designs or images',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-acrylic-prints/',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 10:28:47',
			),
			15 => 
			array (
				'id' => 142,
				'name' => 'Alloy Image Box',
				'short_name' => 'alloy-image-box',
				'sku' => '69208a23-7303-3ae7-b021-f8af89067a39',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Our Alloy Image Box is a brushed metal, photo decor product developed by Anvy Digital.',
				'description' => '<p style="text-align: justify;">The finished, 3D box is contour cut and folded using our patented Photo-Box&trade; cut-and-fold system, fashioning a ready-to-hang product. The self-framing, brushed finish of the Alloy Image Box makes a professional and refined statement. Whether your space longs for a moody black-and-white photo, or a crisp and professional business portrait, Alloy Image Box is brilliant solution.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">Printed directly to metal</li>
<li style="padding: 0px; margin: 0px;">Superior high definition printing</li>
<li style="padding: 0px; margin: 0px;">Indoor durable and long outdoor life</li>
<li style="padding: 0px; margin: 0px;">Can be made up to 5&prime;x10&prime; with&nbsp;standard 1&Prime; edge thickness</li>
<li style="padding: 0px; margin: 0px;">Available in brushed aluminium and gloss white options</li>
<li style="padding: 0px; margin: 0px;">Custom edge colors and image wrap options</li>
<li style="padding: 0px; margin: 0px;">Water &amp; fade resistant with UV liquid coating protection</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<strong style="padding: 0px; margin: 0px;">Why Alloy Box Image?</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">It&rsquo;s the revolutionary new way to display your images and photos from Anvy Digital. &nbsp;At Anvy, our designers and engineers work together through every stage of development. &nbsp;It&rsquo;s what makes remarkable innovation possible. &nbsp;Alloy Box is born from this innovation &ndash; your high-definition photo is printed directly to aluminium, then a protective UV liquid coating is applied. &nbsp;The printed metal sheet is mitre grooved and fabricated to create the finished Alloy Box, which is secured neatly to the wall with concealed keyhole fixings. &nbsp;It looks like raised metal suspended on your wall which gives it a dramatic and spectacular look. &nbsp;Turn your photos into&nbsp;unforgettable&nbsp;art that is perfect for any home or business.</p>
',
				'meta_title' => 'Alloy Image Box',
				'meta_description' => 'Our Alloy Image Box is a brushed metal, photo decor product developed by Anvy Digital.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-alloy-image-box',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 10:50:21',
			),
			16 => 
			array (
				'id' => 143,
				'name' => 'Canvas Wrap',
				'short_name' => 'canvas-wrap',
				'sku' => '8f3c810c-fdcc-3ff4-8d98-9f9ba7da5298',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'The printed canvas is just about everywhere these days.',
				'description' => 'It is the most common and traditional way to get your creative artwork and photos up on the wall to be admired.',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px 0px 10px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">Printed on genuine heavyweight canvas</li>
<li style="padding: 0px; margin: 0px;">Available in 1.25&Prime; frame</li>
<li style="padding: 0px; margin: 0px;">Plain (white), black or image-wrapped edges</li>
<li style="padding: 0px; margin: 0px;">Museum-grade stretcher frames</li>
<li style="padding: 0px; margin: 0px;">Superior High Definition printing</li>
<li style="padding: 0px; margin: 0px;">Water- and fade-resistant</li>
<li style="padding: 0px; margin: 0px;">Indoor durable</li>
<li style="padding: 0px; margin: 0px;">Matte/Satin finish</li>
<li style="padding: 0px; margin: 0px;">All production kept &ldquo;in-house&rdquo; for critical quality control</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<strong style="padding: 0px; margin: 0px;">Why Canvas Wrap?</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Not all Canvas prints are the same. Anvy Digital&rsquo;s promise of quality means prints are built to last. We combine long-lasting museum-grade framing with genuine heavyweight Canvas Wrap and of course, exceptional printing quality.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Turn you favorite images or paintings into unique works of art. Put your photos on canvas for a classic, yet contemporary look with it&rsquo;s real woven texture. Canvas Wraps are printed on real canvas using the latest high definition ultra-violet fade- and water-resistant print technology. Images are printed with pin-sharp clarity directly to the canvas surface with accurate, vibrant color. A matte UV protection liquid coating finishes your Canvas Wrap with long-lasting, memorable display quality.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Your New &ldquo;Old&rdquo; Favourite</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Our Canvas Wrap product has been proven to be fade- and sag-resistant. Trust Anvy to reproduce your images to archival standards only seen in museums and galleries.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Anvy&rsquo;s superior craftsmanship and guarantee, will ensure the Canvas Wrap will only enhance your designs.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Image Wrap Options</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px 0px 10px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">Gallery</li>
<li style="padding: 0px; margin: 0px;">Mirror</li>
<li style="padding: 0px; margin: 0px;">Custom color</li>
</ul>
',
				'meta_title' => 'Canvas Wrap',
				'meta_description' => 'The printed canvas is just about everywhere these days.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-canvas-wrap',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 11:01:55',
			),
			17 => 
			array (
				'id' => 145,
				'name' => 'Illumina Backlit Display',
				'short_name' => 'illumina-backlit-display',
				'sku' => '37e6744a-6e3c-328d-8157-a38369d9b8d6',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Anvy Illumina&trade; Panels are the solution for a wide range of interior retail and visual merchandising applications.',
				'description' => '<p style="text-align: justify;">The easy-open snap frame allows for quick graphic changes and the fine satin-silver finish suits any decor. Illumina&trade; is available in single - and double-faced models and features a robust construction making it available in sizes up to 48&rdquo; x 96&rdquo; in a single faced format. LED low power consumption allows for use with standard households electrical plugs. Can include printed 9mm Illumina&trade; film for additional costs. Pricing varies based on size purchase.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">Bright and consistent illumination</li>
<li style="padding: 0px; margin: 0px;">Energy efficient and environmentally friendly</li>
<li style="padding: 0px; margin: 0px;">Snap frame for easy and quick graphic changes</li>
<li style="padding: 0px; margin: 0px;">Easy installation in any orientation</li>
<li style="padding: 0px; margin: 0px;">White LED edge-lit technology</li>
<li style="padding: 0px; margin: 0px;">Long life and zero maintenance</li>
<li style="padding: 0px; margin: 0px;">Graphic printed on premium 9mm thick Illumina&trade; film</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<strong style="padding: 0px; margin: 0px;">What is an Illumina?</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">An Illumina is a high quality backlit print by Anvy Digital, utilizing premium backlit media, environmental friendly latex-based ink, and unique printing method developed by Anvy Digital. Once you view Illumina all other backlit products are pale by comparison. Illumina is better than duratrans and many other alternatives because not only our printing method delivers blacker blacks and richer colours across the spectrum but also we use latex-based ink on select backlit media.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">With Illumina, your advertisement will become more attractive, your products and offers will shine, and your audience will be captivated.&nbsp; In order to achieve these results, we create Illumina focusing on three important components of a backlit: premium quality substrate, environmental friendly latex-based ink, and high density print mode. Illumina is suitable for any applications where your displays require or have back lights:</p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">Restaurant Menus</li>
<li style="padding: 0px; margin: 0px;">Mall Kiosk Displays</li>
<li style="padding: 0px; margin: 0px;">Theatre Posters</li>
<li style="padding: 0px; margin: 0px;">Airport Signs</li>
<li style="padding: 0px; margin: 0px;">Exhibit Displays</li>
</ul>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Let&rsquo;s your products and offers shine with&nbsp;<strong style="padding: 0px; margin: 0px;"><em style="padding: 0px; margin: 0px;">Illumina</em></strong>.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal; height: 45px;">&nbsp;</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Sizes Available</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Please call for information on sizes and availability.</p>
',
				'meta_title' => 'Illumina Backlit Display',
				'meta_description' => 'Anvy Illumina&trade; Panels are the solution for a wide range of interior retail and visual merchandising applications.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-illumina-backlit-display',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 11:33:35',
			),
			18 => 
			array (
				'id' => 146,
				'name' => 'Wall Decals',
				'short_name' => 'wall-decals',
				'sku' => 'b4328fba-f1cb-3e44-8702-157d4adb7cc6',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Take any high resolution, digital image and put it on your wall as a custom cut-out.',
				'description' => '<p style="text-align: justify;">The images are printed on a reusable, high-tech material known as Image-Tex&trade;. Image-Tex&trade; is safe for almost any surface, in - or outdoors! It can be moved over and over, no glue, no mess, no tacking, no fuss!</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Use It On...</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Elevator doors, trucks and vans, billboards, malls, banks, grocery stores, beauty salons, show booths, photo reproduction, murals, signs, banners, posters, home art, your child&rsquo;s bedroom, and more.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">The Perfect Size</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Image-Tex&trade; comes in several different sizes, and can be cut to suit your needs. Sizes range from 11&quot; x 14&quot; all the way to 24&quot; x 36&quot;.</p>
',
				'technical' => '',
				'meta_title' => 'Wall Decals',
				'meta_description' => 'Take any high resolution, digital image and put it on your wall as a custom cut-out.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-wall-decals',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 15:59:45',
			),
			19 => 
			array (
				'id' => 147,
				'name' => 'Wall Murals',
				'short_name' => 'wall-murals',
				'sku' => '31215bb4-9b0d-36be-b13a-e6004bf122ce',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Adhesive vinyl wall art decals are an inexpensive way to change the look of your room as much as you like.',
				'description' => '<p style="text-align: justify;">Home or office, you can instantly create a hand-painted, contemporary look. Vinyl wall art is designed to last for years but can be removed and replaced at any time. It can be applied and removed without damaging the paint so you can try as many looks as you want.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">Available in high-tack or low-tack removable vinyls</li>
<li style="padding: 0px; margin: 0px;">Sized to fit your space</li>
<li style="padding: 0px; margin: 0px;">Metallic, matte or gloss vinyls available</li>
<li style="padding: 0px; margin: 0px;">Printed images or contour cut lettering and designs available</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Additional Uses</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Anvy Digital works with many clients who use vinyl wall art to accent their offices or work spaces. From large scale wall coverings to small word art, vinyl is the #1 alternative to anything as permanent as painting or wallpaper.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Sizes Available</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Custom sizes are available to suite your needs.</p>
',
				'meta_title' => 'Wall Murals',
				'meta_description' => 'Adhesive vinyl wall art decals are an inexpensive way to change the look of your room as much as you like.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-wall-murals',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 16:03:02',
			),
			20 => 
			array (
				'id' => 148,
				'name' => 'Floor Decals',
				'short_name' => 'floor-decals',
				'sku' => '91f522f6-ce0f-3f8b-a22f-c72192c3c2b4',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Make the most of ALL surfaces with floor decals.',
				'description' => '<p>Colorful graphics, logos and promotions turn functional space into valuable, marketing real estate. These safe, durable and removable decals come in all shapes and sizes.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">We only use high-quality 3M Certified vinyl and floor laminates</li>
<li style="padding: 0px; margin: 0px;">Safe, reliable and easy to install and remove</li>
<li style="padding: 0px; margin: 0px;">Indoor and outdoor applications</li>
<li style="padding: 0px; margin: 0px;">Endures high foot-traffic use</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<strong style="padding: 0px; margin: 0px;">Additional Uses</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">Retail store sales and specials</li>
<li style="padding: 0px; margin: 0px;">Promotion event directional</li>
<li style="padding: 0px; margin: 0px;">Trade shows, fairs and festival advertising</li>
<li style="padding: 0px; margin: 0px;">Sporting events</li>
<li style="padding: 0px; margin: 0px;">Restaurant specials and events</li>
<li style="padding: 0px; margin: 0px;">Banks and hospital directional</li>
<li style="padding: 0px; margin: 0px;">Business services locations</li>
<li style="padding: 0px; margin: 0px;">Theatres and hotels</li>
</ul>

<div style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal; height: 120px;">&nbsp;</div>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Sizes Available</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Custom sizes are available to suite your needs</p>
',
				'meta_title' => 'Floor Decals',
				'meta_description' => 'Make the most of ALL surfaces with floor decals.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-floor-decals',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 11:31:05',
			),
			21 => 
			array (
				'id' => 149,
				'name' => 'Billboards & Roadsides',
				'short_name' => 'billboards-roadsides',
				'sku' => '5db2fe3d-9b15-3f7a-9616-79be25b738cc',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Use outdoor signs to inform the passer-bys about  your company.',
				'description' => '<p style="text-align: justify;">From small signage by doorways to over-sized lot signs, these signs are intended to attract attention. Your sign can be designed for temporary use, or crafted from Dibond&copy; or Crezone&copy; for something more permanent. We use UV curable inks and UV laminates to protect against weather and fading, and general outdoor use.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">Temporary or Permanent Solution</li>
<li style="padding: 0px; margin: 0px;">Durable against Fading and Weather Conditions</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Sizes Available</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Base sheets are 4ft. x 8ft. and can be combined to create a larger sign, or trimmed to meet smaller spaces and needs.</p>
',
				'meta_title' => 'Billboards &amp; Roadsides',
				'meta_description' => 'Use outdoor signs to inform the passer-bys about  your company.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-billboards-roadsides',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 11:25:43',
			),
			22 => 
			array (
				'id' => 151,
				'name' => 'Sandwich Board',
				'short_name' => 'sandwich-board',
				'sku' => '9fe97023-cad9-31b3-bcbe-4fc170d901a2',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Sandwich boards are portable and can be taken in and put out as needed.',
				'description' => '<p style="text-align: justify;">We offer a variety of Sandwich Board styles and formats to grab the attention of pedestrian traffic passing by wherever it is you are conducting your business. Made from weather-resistant and durable materials, our sandwich boards can have changeable and/or reversible panels. Property management companies often use sandwich boards as safety signs; sandwich boards can also be used at trade-shows and conventions, to advertise and/or help people find their way to you.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong>Features</strong><br />
<br />
Full-color prints on &frac12;&rdquo; epoxy-coated Crezon with laminate for extreme durability and superior UV resistance. Complete with steel-reinforced PVC handle, chain and hardware.<br />
<br />
&nbsp;</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Favorite Sizes:</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">32&rdquo; x 24&rdquo;</li>
<li style="padding: 0px; margin: 0px;">36&rdquo; x 24&rdquo;</li>
<li style="padding: 0px; margin: 0px;">24&rdquo; x 48&rdquo;</li>
<li style="padding: 0px; margin: 0px;">32&rdquo; x 48&rdquo;</li>
</ul>
',
				'technical' => '',
				'meta_title' => 'Sandwich Board',
				'meta_description' => 'Sandwich boards are portable and can be taken in and put out as needed.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-sandwich-board',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 14:47:56',
			),
			23 => 
			array (
				'id' => 152,
				'name' => 'Vehicle Graphics',
				'short_name' => 'vehicle-graphics',
				'sku' => '653a607a-ec01-3cf5-bd98-b97ab9cc5df1',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Wrap your company vehicle with catchy graphics and logos to garner attention.',
				'description' => '<p>Perfect for the entrepreneur to raise awareness and promote business while making deliveries or driving about town.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal; width: 350px;" type="disc">
<li style="padding: 0px; margin: 0px;">Durable laminated vehicle vinyl is flexible enough to wrap around corners, rivets and contours</li>
<li style="padding: 0px; margin: 0px;">Long-lasting and easy to clean and wash without peeling</li>
<li style="padding: 0px; margin: 0px;">Contour cuts also available</li>
</ul>
',
				'technical' => '<br />
<br />
<span style="color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">When you want to generate more interest in your business, wrapping your company vehicles is one sure way to grab attention! By applying printed vinyl graphics your vehicle becomes a dynamic and instant mobile advertisement. From concept to design to installation, we provide the complete package. We have the ability to install graphics on one vehicle or your entire fleet. Consider a partial wrap if you are working with a limited budget. Call us today, our customer service and sales staff would be happy to work with you on your project.</span>',
				'meta_title' => 'Vehicle Graphics',
				'meta_description' => 'Wrap your company vehicle with catchy graphics and logos to garner attention.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => 'http://www.pinterest.com/anvydigital/projects-ideas-vehicle-graphics',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 15:40:29',
			),
			24 => 
			array (
				'id' => 153,
				'name' => 'Walkway &amp; Pavement',
				'short_name' => 'walkway-pavement',
				'sku' => '8b4433d1-b6e5-34cb-bb07-3a956b3728e2',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '<p>Make the most of ALL surfaces with decals on your walkways and paved exterior spaces.</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			25 => 
			array (
				'id' => 154,
				'name' => 'Window Decals',
				'short_name' => 'window-decals',
				'sku' => 'b9f0afdc-9a43-3a57-b8a4-77816793b9c5',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Indoor, outdoor, top or bottom, use your windows as free advertising.',
				'description' => '<p>With window decals and graphics from Anvy Digital, you can promote your business, organization, product or event effectively and at low-cost.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">Features</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">Clear, etched-looked, printed or white vinyl available</li>
<li style="padding: 0px; margin: 0px;">Contour cut or full print</li>
<li style="padding: 0px; margin: 0px;">Image-Tex&trade; and Aqua-Tac&trade; products available for windows; contact an Anvy Digital details on these products</li>
<li style="padding: 0px; margin: 0px;">Installation available at additional costs</li>
</ul>

<div style="padding: 0px; margin: 0px;">&nbsp;
<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Additional Uses</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;" type="disc">
<li style="padding: 0px; margin: 0px;">Retail, commercial, service Industry</li>
<li style="padding: 0px; margin: 0px;">Hospitals, medical and professional offices</li>
<li style="padding: 0px; margin: 0px;">Government, public and private offices</li>
<li style="padding: 0px; margin: 0px;">Showrooms and hotels</li>
</ul>

<p class="clr" style="padding: 0px; margin: 1em 0px; clear: both; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; height: 0px !important; line-height: 0px !important;">&nbsp;</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Sizes Available</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Custom sizes are available to suite your needs</p>
</div>
',
				'technical' => '',
				'meta_title' => 'Window Decals',
				'meta_description' => 'Indoor, outdoor, top or bottom, use your windows as free advertising.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => '',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 16:09:50',
			),
			26 => 
			array (
				'id' => 155,
				'name' => 'Brochure Printing',
				'short_name' => 'brochure-printing',
				'sku' => 'bb397986-0c0b-3674-bfc8-0f1f5d0d8b38',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
			'description' => '<p><strong>Size&nbsp;</strong>5.5x8.5&quot; to 11&quot;x25.5&quot; <strong>Paper</strong>100 lb. Paper10 pt. Cardstock <strong>Coating&nbsp;</strong>Gloss (AQ), Matte</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			27 => 
			array (
				'id' => 156,
				'name' => 'Die-Cut Business Cards',
				'short_name' => 'die-cut-business-cards',
				'sku' => '43ab4c82-aae7-3c69-b066-ec92e4af1d27',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '<p><strong>Size&nbsp;</strong>1.5x3.5&quot; to 2x3.5&quot;&nbsp;Custom Size Available</p>
<p><strong>Paper&nbsp;</strong>14 pt Cardstock</p>
<p><strong>Coating&nbsp;</strong>Gloss (AQ), Matte, UV High Gloss</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			28 => 
			array (
				'id' => 157,
				'name' => 'Standard Business Cards',
				'short_name' => 'standard-business-cards',
				'sku' => 'bac040e1-80eb-3179-be91-6f033d83401f',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Size 1.5x3.5&quot; to 2x3.5&quot; Custom Size Available',
			'description' => '<p style="padding: 0px; margin: 15px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Glossy, Matte or Uncoated Paper</p>

<p style="padding: 0px; margin: 15px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Thick 14pt Cardstock Standard,</p>

<p style="padding: 0px; margin: 15px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Square or Slim Shapes</p>

<p>&nbsp;</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
The three most popular standard business card sizes are Standard (2&rdquo; x 3.5&rdquo;), Square (2&rdquo; x 2&rdquo;), and Slim (1.75&rdquo; x 3.5&rdquo;). If you&rsquo;ve got something more creative in mind, you can set custom sizes for your business cards with dimensions ranging from 2&rdquo; to 4&rdquo;. Anvy Digital also offers some business card print designs that can push you, creatively, towards the right direction.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Size 1.5x3.5&quot; to 2x3.5&quot; Custom Size Available</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Paper</strong>&nbsp;14 pt. Cardstock13 pt. Cardstock</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Coating</strong>&nbsp;Uncoated Matte, UV High Gloss</p>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Standard Business Cards</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">At Anvy Digital, you get standard wholesale business cards with the best quality.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Anvy Digital&rsquo;s standard business cards can be used as contact information, save-the-date cards or aid social campaigns. They can help widen your business circle and possibly attract new customers.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">For more information about our standard business cards contact Anvy Digital.</p>
',
				'meta_title' => 'Standard Business Cards',
				'meta_description' => 'Size 1.5x3.5&quot; to 2x3.5&quot; Custom Size Available',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => '',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 15:19:46',
			),
			29 => 
			array (
				'id' => 158,
				'name' => 'Flat Invitations',
				'short_name' => 'flat-invitations',
				'sku' => '943bffdc-72b5-3a89-8d08-a0708b19c43f',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '<p><strong>Size </strong>4.25&quot; x 6&quot; to 5&quot; x 7&quot;</p>
<p><strong>Paper Type</strong> 13 pt. Cardstock Uncoated</p>
<p><strong>Printed Side </strong>Front Only</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			30 => 
			array (
				'id' => 159,
				'name' => 'Folded Invitations',
				'short_name' => 'folded-invitations',
				'sku' => 'e96a461e-65ab-38fc-9ea1-78f4d1dc74d9',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '<p><strong>Size</strong> 10&quot; x 7&quot; to 11&quot; x 8.5&quot;</p>
<p><strong>Paper Type </strong>10 pt. Cardstock Gloss</p>
<p><strong>Folding</strong> Half Folding</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			31 => 
			array (
				'id' => 160,
				'name' => 'Folded Postcards',
				'short_name' => 'folded-postcards',
				'sku' => 'efb9dd94-40d8-3a7b-bb8c-fac84d43cafd',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '<p><strong>Size </strong>10&quot; x 7&quot; to 11&quot; x 8.5&quot;</p>
<p><strong>Paper&nbsp;</strong>10 pt. Cardstock Gloss</p>
<p><strong>Printed Side</strong> Outside Only</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			32 => 
			array (
				'id' => 161,
				'name' => 'Standard Postcards',
				'short_name' => 'standard-postcards',
				'sku' => '7ed42d30-78be-37a0-96c2-18a2112967e1',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '<p><strong>Size&nbsp;</strong>5.5x8.5&quot; to 12x12&quot;</p>
<p><strong>Paper&nbsp;</strong>13 pt. Cardstock Uncoated</p>
<p><strong>Printed Side</strong> Front Only</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			33 => 
			array (
				'id' => 162,
				'name' => 'Wall Calendars',
				'short_name' => 'wall-calendars',
				'sku' => 'bc60920f-2941-30db-aaba-b7372d41c0f9',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
			'description' => '<p><strong>Type </strong>Wall Calendar (28-pages)</p>
<p><strong>Paper&nbsp;</strong>10 pt. Cardstock, 14 pt. Cardstock, 100 lb. Paper, 13 pt. Cardstock</p>
<p><strong>Coating&nbsp;</strong>Gloss (AQ), Matte, Uncoated</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			34 => 
			array (
				'id' => 163,
				'name' => 'Poster Calendars',
				'short_name' => 'poster-calendars',
				'sku' => 'e1416003-cdb7-311f-8e11-affefb9a54be',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
			'description' => '<p><strong>Type </strong>Poster Calendar&nbsp; (28-pages)</p>
<p><strong>Paper&nbsp;</strong>10 pt. &amp;14 pt. Cardstock, 100 lb. Paper, 13 pt. Cardstock</p>
<p><strong>Coating&nbsp;</strong>Gloss (AQ), Matte, Uncoated</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			35 => 
			array (
				'id' => 164,
				'name' => 'Card Calendars',
				'short_name' => 'card-calendars',
				'sku' => 'f91685f8-c2dd-3d1f-bdda-25fedfd83244',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
			'description' => '<p><strong>Type </strong>Card Calendar (28-pages)</p>
<p><strong>Paper&nbsp;</strong>10 pt. &amp; 14 pt. Cardstock, 100 lb. Paper, 13 pt. Cardstock</p>
<p><strong>Coating&nbsp;</strong>Gloss (AQ), Matte, Uncoated</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			36 => 
			array (
				'id' => 166,
				'name' => 'Saddle Stitched Booklets',
				'short_name' => 'saddle-stitched-booklets',
				'sku' => '23ad7978-73b7-378c-a8e1-db7408bb1bc4',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '<p>A popular book binding method.</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			37 => 
			array (
				'id' => 167,
				'name' => 'Tent Cards',
				'short_name' => 'tent-cards',
				'sku' => '59fd4731-15a5-3578-97e2-6a21872cf347',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '<p>Custom Tent Cards</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			38 => 
			array (
				'id' => 168,
				'name' => 'Handouts',
				'short_name' => 'handouts',
				'sku' => '2bc6e586-8509-3ec8-a9f9-b12d2f0ce033',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			39 => 
			array (
				'id' => 169,
				'name' => 'Menus',
				'short_name' => 'menus',
				'sku' => '61e162fc-3c06-3f57-83bb-0d28e96c4bbe',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			40 => 
			array (
				'id' => 170,
				'name' => 'Coupons',
				'short_name' => 'coupons',
				'sku' => 'fc545c7a-625c-3726-949b-33bbb82e611a',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			41 => 
			array (
				'id' => 171,
				'name' => 'Tab Dividers',
				'short_name' => 'tab-dividers',
				'sku' => '2f481125-f4e2-3811-8fa5-2348322ebc95',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			42 => 
			array (
				'id' => 174,
				'name' => 'Cut-Out Prints',
				'short_name' => 'cut-out-prints',
				'sku' => '8f871eed-877e-394a-909c-07d7a6ff3df9',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => NULL,
				'short_description' => NULL,
				'description' => '<p>Make the most of ALL surfaces with cut-out decals.</p>',
				'specification' => NULL,
				'technical' => NULL,
				'meta_title' => NULL,
				'meta_description' => '',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => NULL,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			43 => 
			array (
				'id' => 176,
				'name' => 'Mimi Banner Stand',
				'short_name' => 'mimi-banner-stand',
				'sku' => '1ea6bbf1-ca12-33c3-90cb-d9ca9723606d',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'The Mimi 600 is the narrowest retractable banner stand we carry.',
				'description' => '<p>The Mimi 600 is the narrowest retractable banner stand we carry. The solidarity of the base adds extra stability and the graphic rolls right up into the base for portability.<br />
<br />
*Limited quantities available.</p>
',
				'specification' => '<div style="padding: 0px; margin: 0px;"><br />
<br />
<br />
&nbsp;</div>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
</ul>

<div style="padding: 0px; margin: 0px;"><strong style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Features</strong><br />
&nbsp;</div>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">retractable</li>
<li style="padding: 0px; margin: 0px;">lightweight</li>
<li style="padding: 0px; margin: 0px;">wide stable base&nbsp;</li>
<li style="padding: 0px; margin: 0px;">narrow design</li>
<li style="padding: 0px; margin: 0px;">brilliant full-color graphic included</li>
<li style="padding: 0px; margin: 0px;">optional halogen light available</li>
</ul>
',
				'technical' => '',
				'meta_title' => 'Mimi Banner Stand',
				'meta_description' => 'The Mimi 600 is the narrowest retractable banner stand we carry.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => '',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 14:40:05',
			),
			44 => 
			array (
				'id' => 177,
				'name' => 'Imagestylor Canvas',
				'short_name' => 'imagestylor-canvas',
				'sku' => 'd27997a6-3941-308a-b524-92abb25c4d41',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => 'only 2 working days',
				'short_description' => 'Our newest addition to our canvas product line. Each frame is customizable with any shape and depth.',
				'description' => 'The Imagestylor Canvas is the latest and most innovative product in our wall art decor line. It&rsquo;s a canvas wrap like you&rsquo;ve never seen before! The catch? It&rsquo;s not canvas - it&rsquo;s made from a rigid board with a canvas like texture. The waterproofing allows for outdoor usage &nbsp;giving the Imagestylor Canvas yet another advantage over a canvas wrap. Any shape with an edge can be made-to-order here.<br />
<br />
Choose to wrap your entire image all the way around OR select a fun colour for some creative flare for the edges. The best feature about this product is the fast turn around time of only 2 working days!',
			'specification' => '<div style="padding: 0px; margin: 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<strong style="padding: 0px; margin: 0px;">Features</strong></div>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">Built in house</li>
<li style="padding: 0px; margin: 0px;">Made to order sizes and shapes</li>
<li style="padding: 0px; margin: 0px;">Lightweight&nbsp;</li>
<li style="padding: 0px; margin: 0px;">Wrap made with simulated canvas sheeting</li>
<li style="padding: 0px; margin: 0px;">Styrene backing with keyhole cuts for hanging</li>
<li style="padding: 0px; margin: 0px;">Free-standing backing option available</li>
</ul>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Benefits</strong></p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">2 day turnaround time</li>
<li style="padding: 0px; margin: 0px;">No bounds to templates</li>
<li style="padding: 0px; margin: 0px;">Beat the competition by having unique products</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
Any shape with an edge can be made-to-order, with a minimum depth of 1 inch. Each graphic is directly printed to a dimpled material, emulating the texture of a canvas sheet. Once the frame is complete and the graphic is wrapped, a styrene backing is applied with keyhole cuts for easy hanging.&nbsp;</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">We use a synthethic material called Easy Banner/Poster that has a silky woven texture. It&rsquo;s printed on the Onset Q40i using UV Ink so that the material has the durability for outdoors. The Imagestylor Canvas has a core frame built from coroplast, increasing its weather durability.&nbsp;</p>
',
				'meta_title' => 'Imagestylor Canvas',
				'meta_description' => 'Our newest addition to our canvas product line. Each frame is customizable with any shape and depth.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => '',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-20 11:40:49',
			),
			45 => 
			array (
				'id' => 178,
				'name' => 'Smart Plaque',
				'short_name' => 'smart-plaque',
				'sku' => 'd63a94cd-fbe4-3d88-8216-247b682dceff',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'A lightweight and durable direct print plaque.',
				'description' => '<p style="text-align: justify;">Plaques are a great way to depict something of value and importance. Typically used to mark an event or a person, a plaque&rsquo;s importance is revealed by its quality. We&rsquo;ve created a direct print plaque board that can be used to depict any occasion or message with the same quality and prestige.&nbsp;<br />
<br />
The Smart Plaque is a direct print to a highly durable and waterproof subtrate, which makes it great for indoor and outdoor applications. It is very ridgid, with a high UV stability and humidity resistance. There is no adhesive between any layers of the print or the core which means &nbsp;your plaque is a solid piece of display signage.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
Thicknesses Available:</p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">10mm (3/8&quot;)</li>
</ul>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Benefits:</p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">Smooth face</li>
<li style="padding: 0px; margin: 0px;">Waterproof</li>
<li style="padding: 0px; margin: 0px;">Indoor and Outdoor applications</li>
<li style="padding: 0px; margin: 0px;">Very rigid and durable</li>
<li style="padding: 0px; margin: 0px;">Sizes up to 4&rsquo;x8&rsquo;</li>
<li style="padding: 0px; margin: 0px;">Several mounting options</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><br />
<br />
<strong style="padding: 0px; margin: 0px;">What is SMART-X?</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">SMART-X is a lightweight, mono-material composite made from 100% polystyrene, rendering this product completely recycable, making a great addition to our eco-friendly line of products. SMART-X is a sheet material with surfaces of UV and weather resistant solid polystyrene (HIPS) and a core of expanded polystyrene that is completely moisture-resistant.The Smart Plaque can be used in both indoor and outdoor applications.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">This all plastic foam board is typically used in sophicated visual applications and accepts colour brilliantly.&nbsp;</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Finishing</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Edges are finished with either black or white stripping for a smooth, clean and professional look.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Want something more creative? Upgrade to colour stripping for a unique display.&nbsp;</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong style="padding: 0px; margin: 0px;">Mounting Options</strong></p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Floating: Soft gel bumpers are added to the underside for added stability when hanging so your plaque doesn&rsquo;t sway with passerbys.&nbsp;</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Flush: Keyhole cuts into the underside of the material allow for a flush look against the wall.</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">Standoffs: Upgrade to a wide selection of standoffs (pictured below) for a more impressive look.</p>
',
				'meta_title' => 'Smart Plaque',
				'meta_description' => 'A lightweight and durable direct print plaque.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => '',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-23 22:19:45',
			),
			46 => 
			array (
				'id' => 179,
				'name' => 'Tri-photo HBL',
				'short_name' => 'tri-photo-hbl',
				'sku' => '8e5f12e0-eb95-3ca0-b924-f1c18af8c0f8',
				'sell_price' => 0,
				'margin_up' => 0,
				'working_time' => '',
				'short_description' => 'Comprised of several layers, for a rigid, highly durable and fade proof graphic.',
			'description' => '<p style="text-align: justify;">Our Tri-photo HBL (high bond laminate) is comprised of several materials layered together by a high pressurized system. The tri-photo HBL has three layers: a base, the graphic and the protective laminate.<br />
<br />
The graphic is printed directly to a metal composite, then a layer of solid, clear laminate is applied on top using high pressured compressors.<br />
<br />
The result is a beautiful wear resistant substrate perfect for high traffic areas in tradeshows, schools, retail spaces, hotels, museums, hospitals, anywhere that needs protective signage. It&rsquo;s extremely durable, scuff proof and the graphic will never fade.<br />
<br />
The Tri-photo HBL graphic is printed using the Onset Q40i with UV Ink.</p>
',
			'specification' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong>Features</strong>:</p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">Crack resistant</li>
<li style="padding: 0px; margin: 0px;">Impact resistant</li>
<li style="padding: 0px; margin: 0px;">Abrasion resistant</li>
<li style="padding: 0px; margin: 0px;">Moisture resistant</li>
<li style="padding: 0px; margin: 0px;">Scratch resistant&nbsp;</li>
<li style="padding: 0px; margin: 0px;">Heat resistant&nbsp;</li>
<li style="padding: 0px; margin: 0px;">Flame retardant&nbsp;</li>
<li style="padding: 0px; margin: 0px;">Graphic does not fade</li>
</ul>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;">&nbsp;</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; line-height: normal;"><strong>Specs</strong>:</p>

<ul style="padding-right: 0px; padding-left: 20px; margin: 0px; list-style-position: outside; list-style-image: none; color: rgb(102, 102, 102); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; line-height: normal;">
<li style="padding: 0px; margin: 0px;">4mm or 8mm thickness&nbsp;</li>
<li style="padding: 0px; margin: 0px;">Satin or Matte finish&nbsp;</li>
<li style="padding: 0px; margin: 0px;">Die cut available</li>
</ul>
',
			'technical' => '<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);">&nbsp;The Tri-photo HBL can be mounted using standoffs. Call us for a preview of our wide selection of styles and colours!</p>

<p style="padding: 0px; margin: 1em 0px; color: rgb(63, 63, 63); font-family: \'Open Sans\', Arial, Helvetica, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);"><img alt="" src="/assets/images/editor/standoff(1).jpg" style="padding: 0px; margin: 0px; width: 700px; height: 392px;" /></p>
',
				'meta_title' => 'Tri-photo HBL',
				'meta_description' => 'Comprised of several layers, for a rigid, highly durable and fade proof graphic.',
				'active' => 1,
				'order_no' => 1,
				'svg_layout_id' => 0,
				'custom_size' => 1,
				'pinterest' => '',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2015-07-24 10:20:19',
			),
		));
	}

}
