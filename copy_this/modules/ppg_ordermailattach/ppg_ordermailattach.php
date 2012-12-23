<?php

class ppg_ordermailattach extends ppg_ordermailattach_parent
{
    public function sendOrderEmailToUser( $oOrder, $sSubject = null ) {
        $myConfig = $this->getConfig();

        // add user defined stuff if there is any
        $oOrder = parent::_addUserInfoOrderEMail( $oOrder );

        $oShop = parent::_getShop();
        $this->_setMailParams( $oShop );

        $oUser = $oOrder->getOrderUser();
        $this->setUser( $oUser );

        // create messages
        $oSmarty = $this->_getSmarty();
        $this->setViewData( "order", $oOrder);

        if ( $myConfig->getConfigParam( "bl_perfLoadReviews" ) ) {
            $this->setViewData( "blShowReviewLink", true );
        }

        // Process view data array through oxoutput processor
        $this->_processViewArray();

        $this->setBody( $oSmarty->fetch( $this->_sOrderUserTemplate ) );
        $this->setAltBody( $oSmarty->fetch( $this->_sOrderUserPlainTemplate ) );

        // #586A
        if ( $sSubject === null ) {
            if ( $oSmarty->template_exists( $this->_sOrderUserSubjectTemplate) ) {
                $sSubject = $oSmarty->fetch( $this->_sOrderUserSubjectTemplate );
            } else {
                $sSubject = $oShop->oxshops__oxordersubject->getRawValue()." (#".$oOrder->oxorder__oxordernr->value.")";
            }
        }

        $this->setSubject( $sSubject );

        $sFullName = $oUser->oxuser__oxfname->getRawValue() . " " . $oUser->oxuser__oxlname->getRawValue();

        $this->setRecipient( $oUser->oxuser__oxusername->value, $sFullName );
        $this->setReplyTo( $oShop->oxshops__oxorderemail->value, $oShop->oxshops__oxname->getRawValue() );

        /* BOF My ADD: AGB per PDF */
        $attachment_path=$myConfig->getTranslationsDir( $myConfig->getConfigParam("ppgOrderMailAttachementDE"), oxRegistry::getLang()->getLanguageAbbr( $iBaseId ) );
        parent::addAttachment( $attachment_path );
        /* EOF My ADD */
        
        $blSuccess = $this->send();

        return $blSuccess;
    }

} 