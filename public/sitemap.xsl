<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" 
                xmlns:html="http://www.w3.org/TR/REC-html40"
                xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
                xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
  <xsl:template match="/">
    <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <title>SITEMAP by HVM DIGITAL</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
          body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 14px; color: #333; margin: 0; background: #f4f4f5; padding: 40px 20px; }
          #container { max-width: 960px; margin: 0 auto; background: #ffffff; padding: 40px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
          .header { border-bottom: 2px solid #f3f4f6; padding-bottom: 24px; margin-bottom: 30px; text-align: center; }
          h1 { font-size: 28px; color: #111827; margin: 0 0 8px 0; font-weight: 800; letter-spacing: -0.5px; }
          h1 span { color: #6b7280; font-weight: 400; font-size: 18px; letter-spacing: 0; margin-left: 10px; }
          .header p { margin: 0; color: #6b7280; font-size: 15px; }
          
          table { width: 100%; border-collapse: collapse; margin-top: 20px; }
          th { text-align: left; background: #111827; color: #ffffff; padding: 14px 16px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; border-radius: 4px 4px 0 0; }
          td { padding: 14px 16px; border-bottom: 1px solid #e5e7eb; color: #4b5563; font-size: 14px; }
          tr:last-child td { border-bottom: none; }
          tr:hover td { background: #f9fafb; color: #111827; }
          
          a { color: #2563eb; text-decoration: none; transition: color 0.2s; }
          a:hover { color: #1d4ed8; text-decoration: underline; }
          
          .watermark { text-align: center; margin-top: 50px; padding-top: 24px; font-size: 11px; color: #9ca3af; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; border-top: 1px dashed #e5e7eb; }
          
          @media (max-width: 768px) {
            #container { padding: 24px 16px; }
            th, td { padding: 12px 10px; font-size: 13px; }
            table { display: block; overflow-x: auto; white-space: nowrap; }
          }
        </style>
      </head>
      <body>
        <div id="container">
          <div class="header">
            <h1>SITEMAP <span>by HVM DIGITAL</span></h1>
            <p>Peta situs XML ini dibuat untuk memudahkan mesin pencari mengindeks struktur website.</p>
          </div>
          
          <table>
            <thead>
              <tr>
                <th>URL</th>
                <th width="15%">Priority</th>
                <th width="15%">Change Freq</th>
                <th width="20%">Last Modified</th>
              </tr>
            </thead>
            <tbody>
              <xsl:for-each select="sitemap:urlset/sitemap:url">
                <tr>
                  <td>
                    <a href="{sitemap:loc}"><xsl:value-of select="sitemap:loc"/></a>
                  </td>
                  <td>
                    <xsl:if test="sitemap:priority">
                      <xsl:value-of select="sitemap:priority"/>
                    </xsl:if>
                    <xsl:if test="not(sitemap:priority)">-</xsl:if>
                  </td>
                  <td>
                    <xsl:if test="sitemap:changefreq">
                      <xsl:value-of select="sitemap:changefreq"/>
                    </xsl:if>
                    <xsl:if test="not(sitemap:changefreq)">-</xsl:if>
                  </td>
                  <td>
                    <xsl:if test="sitemap:lastmod">
                      <xsl:value-of select="sitemap:lastmod"/>
                    </xsl:if>
                    <xsl:if test="not(sitemap:lastmod)">-</xsl:if>
                  </td>
                </tr>
              </xsl:for-each>
            </tbody>
          </table>
          
          <div class="watermark">
            developed by HVM DIGITAL
          </div>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
