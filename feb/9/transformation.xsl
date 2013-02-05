<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:product="http://competec.ch/product"
                xmlns:images="http://competec.ch/images"
                exclude-result-prefixes="product images">

    <xsl:output encoding="UTF-8" indent="yes" method="xml" />
    <xsl:template match="/">
    <div>
        <h1>Preise tabellarisch dargestellt</h1>
        <table>
            <xsl:for-each select="//product:product/product:prices/product:price">
                <tr>
                    <xsl:attribute name="class">
                    <xsl:choose>
                        <xsl:when test="position() mod 2">
                            <xsl:text>even</xsl:text>
                        </xsl:when>
                        <xsl:otherwise>
                            <xsl:text>odd</xsl:text>
                        </xsl:otherwise>
                    </xsl:choose>
                    </xsl:attribute>
                    <td><xsl:value-of select="@class" /> für <xsl:value-of select="@value" /></td>
                </tr>
            </xsl:for-each>
        </table>
    </div>
    </xsl:template>

</xsl:stylesheet>