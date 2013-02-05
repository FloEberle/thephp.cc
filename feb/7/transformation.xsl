<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:product="http://competec.ch/product" exclude-result-prefixes="product">

    <xsl:output encoding="UTF-8" indent="yes" method="xml" />
    <xsl:template match="/">
    <div>
        <h1>Sortierte Preise</h1>
        <ul>
            <xsl:for-each select="//product:product/product:prices/product:price">
                <xsl:sort order="ascending" select="@value" data-type="number" />
                <li><xsl:value-of select="@class" /> Preis <xsl:value-of select="@value" /></li>
            </xsl:for-each>
        </ul>
    </div>
    </xsl:template>

</xsl:stylesheet>