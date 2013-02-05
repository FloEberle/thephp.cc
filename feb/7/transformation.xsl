<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:product="http://competec.ch/product" exclude-result-prefixes="product">

    <xsl:output encoding="UTF-8" indent="yes" method="xml" />
    <xsl:template match="/">
    <div>
        <h1>Sortierte Preise</h1>
        <ul>
            <xsl:apply-templates select="//product:product/product:prices/product:price[@value &gt; 700]" >
                <xsl:sort order="ascending" select="@value" data-type="number" />
            </xsl:apply-templates>
        </ul>
    </div>
    </xsl:template>

    <xsl:template match="product:price">
        <li><xsl:value-of select="@class" /> Preis <xsl:value-of select="@value" /></li>
    </xsl:template>

    <xsl:template match="product:price[@class = 'enduser']">
        <li class='bold'><xsl:value-of select="@class" /> Preis <xsl:value-of select="@value" /></li>
    </xsl:template>



</xsl:stylesheet>