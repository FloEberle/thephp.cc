<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:product="http://competec.ch/product"
                xmlns:images="http://competec.ch/images"
                exclude-result-prefixes="product images">

    <xsl:output encoding="UTF-8" indent="yes" method="xml" />
    <xsl:template match="/">
    <div>
        <h1>Preise tabellarisch mit 2 Spalten dargestellt</h1>
        <table>
            <xsl:for-each select="//product:product/product:prices/product:price[position() mod 2 = 1]">
                <tr>
                    <td><xsl:value-of select="@class" /> für <xsl:value-of select="@value" /></td>
                    <td>
                        <xsl:if test="string-length(following-sibling::product:price/@value) > 0">
                            <xsl:value-of select="following-sibling::product:price/@class" /> für <xsl:value-of select="following-sibling::product:price/@value" />
                        </xsl:if>
                    </td>
                </tr>
            </xsl:for-each>
        </table>
    </div>
    </xsl:template>

</xsl:stylesheet>