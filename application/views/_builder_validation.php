<div class="jumbotron" data-pages="parallax">
	<div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
		<div class="inner">
			<ul class="breadcrumb">
				<li>
					<p>Pages</p>
				</li>
				<li>
					<a href="<?=base_url();?>campagnes.html">Campagnes</a>
				</li>
				<li>
					<a href="<?=base_url();?>builder/campagne_informations/modification/<?=$id_newsletter?>.html">Informations</a>
				</li>
				<li>
					<a href="<?=base_url();?>builder/campagne/newsletter/<?=$id_newsletter?>.html">Newsletter</a>
				</li>
				<li>
					<a href="<?=base_url();?>builder/campagne/validation/<?=$id_newsletter?>.html" class="active">Validation newsletter</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="container-fluid container-fixed-lg">
	<div class="erreur alert alert-danger">
		<strong class="message"></strong>
		<button class="close"></button>
	</div>
	<div class="page-container">
		<div class="main-content">
			<div class="row">
				<div data-pages="portlet" class="panel panel-default" id="portlet-basic">
					<div class="panel-heading">
						<div class="panel-title">Votre newsletter <?=$nom_campagne?></div>
						<div class="panel-controls">
							<ul>
								<li><a data-toggle="collapse" class="portlet-collapse" href="#"><i
								class="portlet-icon portlet-icon-collapse"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="body clearFloat noPadding border center-block col-lg-8 newsBuilder noHover">
						<?=$newsletter?>
					</div>
					<div class="panel-footer text-right">
						<a href="/builder/newsletter_html/<?=$id_newsletter?>.html" class="btn btn-success">VALIDER</a>
					</div>
				</div>
			</div>
		</div>
	<script type="text/javascript">
		$('.text_to_replace').each( function (){
			text_to_replace = $(this).text();
			text_replaced = text_to_replace.replace(/#&§#&§/g, '"');
			$(this).text(text_replaced);
		});
	</script>
