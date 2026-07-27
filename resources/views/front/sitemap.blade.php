{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemap.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemap.org/schemas/sitemap/0.9
        http://www.sitemap.org/schemas/sitemap/0.9/sitemap.xsd">

    <!-- Static Pages -->
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>{{ route('about') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ route('contact') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>

    <!-- Dynamic Photography Showcase Items -->
    @foreach ($photographies as $photography)
        <url>
            <loc>{{ route('photography.show', $photography->slug) }}</loc>
            <lastmod>{{ $photography->updated_at ? $photography->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.90</priority>
        </url>
    @endforeach
</urlset>
