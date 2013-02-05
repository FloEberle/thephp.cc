<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:product="http://competec.ch/product"
                xmlns:images="http://competec.ch/images"
                exclude-result-prefixes="product images">

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
        <li><xsl:call-template name="imagesStartingWithXX"></xsl:call-template></li>
    </xsl:template>

    <xsl:template match="product:price[@class = 'enduser']">
        <li class='bold'><xsl:value-of select="@class" /> Preis <xsl:value-of select="@value" /></li>
        <li><xsl:call-template name="imagesStartingWithXX"></xsl:call-template></li>
    </xsl:template>

    <xsl:template name="imagesStartingWithXX">
        <!--<xsl:for-each select="//product:product/images:images/images:image/images:size[matches(@variant, '^xx[^x].*')]">-->
        <xsl:for-each select="//product:product/images:images/images:image/images:size[starts-with(@variant, 'xx') and not(substring(@variant, 3, 1) ='x')]">
            <img>
                <xsl:attribute name="src">
                    <xsl:value-of select="@src" />
                </xsl:attribute>
                <xsl:attribute name="class">
                    <xsl:value-of select="@variant" />
                </xsl:attribute>
            </img>
        </xsl:for-each>

    </xsl:template>



</xsl:stylesheet>