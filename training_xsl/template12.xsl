<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">

        <div>
            <xsl:call-template name="showDesc">
                <xsl:with-param name="context" select="//description[1]" />
                <xsl:with-param name="class" select="//description[1]/@type" />
            </xsl:call-template>
        </div>
    </xsl:template>

    <xsl:template name="showDesc">
        <xsl:param name="context" />
        <xsl:param name="class" select="'bold'" />

        <p class="{$class}"><xsl:value-of select="$context" /></p>
    </xsl:template>

</xsl:stylesheet>