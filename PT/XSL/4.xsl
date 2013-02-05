<xsl:stylesheet version='1.0'
                xmlns:img="http://competec.ch/images"
                xmlns:p="http://competec.ch/product"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                exclude-result-prefixes="p">
    <xsl:output indent="yes" />
    <xsl:template match="/">
        <div>
            <xsl:apply-templates select="//p:price[@value &gt; 700]">
                <xsl:sort order="ascending" data-type="number" select="@value"/>
            </xsl:apply-templates>
        </div>
    </xsl:template>
    <xsl:template match="p:price[@class='enduser']">
       <strong><xsl:value-of select="@value"/></strong>
        <xsl:call-template name="image" />
    </xsl:template>
    <xsl:template match="p:price">
            <p>
                <xsl:value-of select="@value"/>
                <xsl:call-template name="image" />


            </p>
    </xsl:template>
    <xsl:template name="image">
            <p>
                <xsl:for-each select="//img:size[starts-with(@variant, 'xx') and not(starts-with(@variant, 'xxx'))]">
                    <xsl:value-of select="@src" />
                </xsl:for-each>
            </p>
    </xsl:template>
</xsl:stylesheet>