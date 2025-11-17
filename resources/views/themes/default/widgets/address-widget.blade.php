<div class="relative flex h-full w-full flex-col gap-4">
	<x-heading label="Alamat" />
	<x-widgets.location-widget height="h-64" :place="$generalSetting->site_name" :address="$locationSetting->address" :latitude="$locationSetting->latitude" :longitude="$locationSetting->longitude" />
</div>
