<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:ex="http://competec.ch/product">
	<xsl:template match="/">
	<div>	
			<xsl:for-each select="//ex:price">
					<xsl:sort order="descending" select="@value" data-type="number" />
					<xsl:call-template name="price" />
			</xsl:for-each>
	</div>		
	</xsl:template>
	
	
	<xsl:template name="price">
		<xsl:value-of select="@value" /><xsl:text>&#10;</xsl:text>
	</xsl:template>
	
</xsl:stylesheet>
