<?php
/**
 * Section: FAQs (with FAQ structured data for search results).
 *
 * @package DeeproseCarter
 */

$dc_items = (array) get_sub_field( 'items' );
$dc_schema = array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array() );
?>
<section class="faq pad" id="faqs"><div class="wrap"><div class="grid">
	<div>
		<?php dc_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
		<h2><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
		<?php dc_link( get_sub_field( 'button' ), 'btn btn-line', 'margin-top:32px' ); ?>
	</div>
	<div>
		<?php foreach ( array_values( $dc_items ) as $dc_i => $dc_q ) : ?>
			<?php
			$dc_schema['mainEntity'][] = array(
				'@type'          => 'Question',
				'name'           => wp_strip_all_tags( $dc_q['question'] ),
				'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $dc_q['answer'] ) ),
			);
			?>
			<details<?php echo 0 === $dc_i ? ' open' : ''; ?>><summary><?php echo esc_html( $dc_q['question'] ); ?></summary><div class="answer"><?php echo wp_kses_post( $dc_q['answer'] ); ?></div></details>
		<?php endforeach; ?>
	</div>
</div></div></section>
<?php if ( $dc_schema['mainEntity'] ) : ?>
<script type="application/ld+json"><?php echo wp_json_encode( $dc_schema ); ?></script>
<?php endif; ?>
