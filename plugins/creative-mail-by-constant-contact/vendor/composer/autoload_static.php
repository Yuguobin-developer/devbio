<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcf64331d344d60cdd7c271d9659d62f2
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'D' => 
        array (
            'Defuse\\Crypto\\' => 14,
        ),
        'C' => 
        array (
            'CreativeMail\\Modules\\' => 21,
            'CreativeMail\\Models\\' => 20,
            'CreativeMail\\Managers\\' => 22,
            'CreativeMail\\Integrations\\' => 26,
            'CreativeMail\\Helpers\\' => 21,
            'CreativeMail\\Constants\\' => 23,
            'CreativeMail\\Blocks\\' => 20,
            'CreativeMail\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'Defuse\\Crypto\\' => 
        array (
            0 => __DIR__ . '/..' . '/defuse/php-encryption/src',
        ),
        'CreativeMail\\Modules\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/modules',
        ),
        'CreativeMail\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/models',
        ),
        'CreativeMail\\Managers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/managers',
        ),
        'CreativeMail\\Integrations\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/integrations',
        ),
        'CreativeMail\\Helpers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/helpers',
        ),
        'CreativeMail\\Constants\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/constants',
        ),
        'CreativeMail\\Blocks\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/blocks',
        ),
        'CreativeMail\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'Raygun4php' => 
            array (
                0 => __DIR__ . '/..' . '/mindscape/raygun4php/src',
            ),
        ),
    );

    public static $classMap = array (
        'CreativeMail\\Blocks\\LoadBlock' => __DIR__ . '/../..' . '/src/blocks/LoadBlock.php',
        'CreativeMail\\Clients\\CreativeMailClient' => __DIR__ . '/../..' . '/src/Clients/CreativeMailClient.php',
        'CreativeMail\\Constants\\EnvironmentNames' => __DIR__ . '/../..' . '/src/Constants/EnvironmentNames.php',
        'CreativeMail\\CreativeMail' => __DIR__ . '/../..' . '/src/CreativeMail.php',
        'CreativeMail\\Exceptions\\CreativeMailException' => __DIR__ . '/../..' . '/src/Exceptions/CreativeMailException.php',
        'CreativeMail\\Helpers\\EncryptionHelper' => __DIR__ . '/../..' . '/src/Helpers/EncryptionHelper.php',
        'CreativeMail\\Helpers\\EnvironmentHelper' => __DIR__ . '/../..' . '/src/Helpers/EnvironmentHelper.php',
        'CreativeMail\\Helpers\\GuidHelper' => __DIR__ . '/../..' . '/src/Helpers/GuidHelper.php',
        'CreativeMail\\Helpers\\OptionsHelper' => __DIR__ . '/../..' . '/src/Helpers/OptionsHelper.php',
        'CreativeMail\\Helpers\\SsoHelper' => __DIR__ . '/../..' . '/src/Helpers/SsoHelper.php',
        'CreativeMail\\Integrations\\Integration' => __DIR__ . '/../..' . '/src/Integrations/Integration.php',
        'CreativeMail\\Managers\\AdminManager' => __DIR__ . '/../..' . '/src/Managers/AdminManager.php',
        'CreativeMail\\Managers\\ApiManager' => __DIR__ . '/../..' . '/src/Managers/ApiManager.php',
        'CreativeMail\\Managers\\CheckoutManager' => __DIR__ . '/../..' . '/src/Managers/CheckoutManager.php',
        'CreativeMail\\Managers\\DatabaseManager' => __DIR__ . '/../..' . '/src/Managers/DatabaseManager.php',
        'CreativeMail\\Managers\\EmailManager' => __DIR__ . '/../..' . '/src/Managers/EmailManager.php',
        'CreativeMail\\Managers\\FormManager' => __DIR__ . '/../..' . '/src/Managers/FormManager.php',
        'CreativeMail\\Managers\\InstanceManager' => __DIR__ . '/../..' . '/src/Managers/InstanceManager.php',
        'CreativeMail\\Managers\\IntegrationManager' => __DIR__ . '/../..' . '/src/Managers/IntegrationManager.php',
        'CreativeMail\\Managers\\RaygunManager' => __DIR__ . '/../..' . '/src/Managers/RaygunManager.php',
        'CreativeMail\\Models\\ApiSchema' => __DIR__ . '/../..' . '/src/Models/ApiSchema.php',
        'CreativeMail\\Models\\Campaign' => __DIR__ . '/../..' . '/src/Models/Campaign.php',
        'CreativeMail\\Models\\CartData' => __DIR__ . '/../..' . '/src/Models/CartData.php',
        'CreativeMail\\Models\\Checkout' => __DIR__ . '/../..' . '/src/Models/Checkout.php',
        'CreativeMail\\Models\\CheckoutSave' => __DIR__ . '/../..' . '/src/Models/CheckoutSave.php',
        'CreativeMail\\Models\\Coupon' => __DIR__ . '/../..' . '/src/Models/Coupon.php',
        'CreativeMail\\Models\\CustomerNewAccount' => __DIR__ . '/../..' . '/src/Models/CustomerNewAccount.php',
        'CreativeMail\\Models\\CustomerNote' => __DIR__ . '/../..' . '/src/Models/CustomerNote.php',
        'CreativeMail\\Models\\CustomerResetPassword' => __DIR__ . '/../..' . '/src/Models/CustomerResetPassword.php',
        'CreativeMail\\Models\\EmailNotification' => __DIR__ . '/../..' . '/src/Models/EmailNotification.php',
        'CreativeMail\\Models\\HashSchema' => __DIR__ . '/../..' . '/src/Models/HashSchema.php',
        'CreativeMail\\Models\\OptionsSchema' => __DIR__ . '/../..' . '/src/Models/OptionsSchema.php',
        'CreativeMail\\Models\\Order' => __DIR__ . '/../..' . '/src/Models/Order.php',
        'CreativeMail\\Models\\OrderBilling' => __DIR__ . '/../..' . '/src/Models/OrderBilling.php',
        'CreativeMail\\Models\\OrderBillingPaymentDetails' => __DIR__ . '/../..' . '/src/Models/OrderBillingPaymentDetails.php',
        'CreativeMail\\Models\\OrderBillingShipping' => __DIR__ . '/../..' . '/src/Models/OrderBillingShipping.php',
        'CreativeMail\\Models\\OrderLineItem' => __DIR__ . '/../..' . '/src/Models/OrderLineItem.php',
        'CreativeMail\\Models\\RequestItem' => __DIR__ . '/../..' . '/src/Models/RequestItem.php',
        'CreativeMail\\Models\\Response' => __DIR__ . '/../..' . '/src/Models/Response.php',
        'CreativeMail\\Models\\TriggerExecution' => __DIR__ . '/../..' . '/src/Models/TriggerExecution.php',
        'CreativeMail\\Models\\User' => __DIR__ . '/../..' . '/src/Models/User.php',
        'CreativeMail\\Modules\\Api\\Models\\ApiRequestItem' => __DIR__ . '/../..' . '/src/Modules/Api/Models/ApiRequestItem.php',
        'CreativeMail\\Modules\\Api\\Processes\\ApiBackgroundProcess' => __DIR__ . '/../..' . '/src/Modules/Api/Processes/ApiBackgroundProcess.php',
        'CreativeMail\\Modules\\Blog\\Models\\BlogAttachment' => __DIR__ . '/../..' . '/src/Modules/Blog/Models/BlogAttachment.php',
        'CreativeMail\\Modules\\Blog\\Models\\BlogInformation' => __DIR__ . '/../..' . '/src/Modules/Blog/Models/BlogInformation.php',
        'CreativeMail\\Modules\\Blog\\Models\\BlogPost' => __DIR__ . '/../..' . '/src/Modules/Blog/Models/BlogPost.php',
        'CreativeMail\\Modules\\Contacts\\Exceptions\\InvalidContactSyncBackgroundRequestException' => __DIR__ . '/../..' . '/src/Modules/Contacts/Exceptions/InvalidContactSyncBackgroundRequestException.php',
        'CreativeMail\\Modules\\Contacts\\Exceptions\\InvalidHandlerContactSyncRequestException' => __DIR__ . '/../..' . '/src/Modules/Contacts/Exceptions/InvalidHandlerContactSyncRequestException.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\BaseContactFormPluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/BaseContactFormPluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\BlueHostBuilderPluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/BlueHostBuilderPluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\CalderaPluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/CalderaPluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\ContactFormSevenPluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/ContactFormSevenPluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\CreativeMailPluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/CreativeMailPluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\ElementorPluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/ElementorPluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\FormidablePluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/FormidablePluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\GravityFormsPluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/GravityFormsPluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\JetpackPluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/JetpackPluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\NewsLetterContactFormPluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/NewsLetterContactFormPluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\NinjaFormsPluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/NinjaFormsPluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\WooCommercePluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/WooCommercePluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Handlers\\WpFormsPluginHandler' => __DIR__ . '/../..' . '/src/Modules/Contacts/Handlers/WpFormsPluginHandler.php',
        'CreativeMail\\Modules\\Contacts\\Managers\\ContactsSyncManager' => __DIR__ . '/../..' . '/src/Modules/Contacts/Managers/ContactsSyncManager.php',
        'CreativeMail\\Modules\\Contacts\\Models\\ContactAddressModel' => __DIR__ . '/../..' . '/src/Modules/Contacts/Models/ContactAddressModel.php',
        'CreativeMail\\Modules\\Contacts\\Models\\ContactFormSevenSubmission' => __DIR__ . '/../..' . '/src/Modules/Contacts/Models/ContactFormSevenSubmission.php',
        'CreativeMail\\Modules\\Contacts\\Models\\ContactModel' => __DIR__ . '/../..' . '/src/Modules/Contacts/Models/ContactModel.php',
        'CreativeMail\\Modules\\Contacts\\Models\\FormidableContactForm' => __DIR__ . '/../..' . '/src/Modules/Contacts/Models/FormidableContactForm.php',
        'CreativeMail\\Modules\\Contacts\\Models\\OptActionBy' => __DIR__ . '/../..' . '/src/Modules/Contacts/Models/OptActionBy.php',
        'CreativeMail\\Modules\\Contacts\\Processors\\ContactsSyncBackgroundProcessor' => __DIR__ . '/../..' . '/src/Modules/Contacts/Processors/ContactsSyncBackgroundProcessor.php',
        'CreativeMail\\Modules\\Contacts\\Services\\ContactsSyncService' => __DIR__ . '/../..' . '/src/Modules/Contacts/Services/ContactsSyncService.php',
        'CreativeMail\\Modules\\DashboardWidgetModule' => __DIR__ . '/../..' . '/src/Modules/DashboardWidgetModule.php',
        'CreativeMail\\Modules\\FeedbackNoticeModule' => __DIR__ . '/../..' . '/src/Modules/FeedbackNoticeModule.php',
        'CreativeMail\\Modules\\WooCommerce\\Emails\\AbandonedCartEmail' => __DIR__ . '/../..' . '/src/Modules/WooCommerce/Emails/AbandonedCartEmail.php',
        'CreativeMail\\Modules\\WooCommerce\\Models\\WCInformationModel' => __DIR__ . '/../..' . '/src/Modules/WooCommerce/Models/WCInformationModel.php',
        'CreativeMail\\Modules\\WooCommerce\\Models\\WCProductModel' => __DIR__ . '/../..' . '/src/Modules/WooCommerce/Models/WCProductModel.php',
        'CreativeMail\\Modules\\WooCommerce\\Models\\WCStoreInformation' => __DIR__ . '/../..' . '/src/Modules/WooCommerce/Models/WCStoreInformation.php',
        'Defuse\\Crypto\\Core' => __DIR__ . '/..' . '/defuse/php-encryption/src/Core.php',
        'Defuse\\Crypto\\Crypto' => __DIR__ . '/..' . '/defuse/php-encryption/src/Crypto.php',
        'Defuse\\Crypto\\DerivedKeys' => __DIR__ . '/..' . '/defuse/php-encryption/src/DerivedKeys.php',
        'Defuse\\Crypto\\Encoding' => __DIR__ . '/..' . '/defuse/php-encryption/src/Encoding.php',
        'Defuse\\Crypto\\Exception\\BadFormatException' => __DIR__ . '/..' . '/defuse/php-encryption/src/Exception/BadFormatException.php',
        'Defuse\\Crypto\\Exception\\CryptoException' => __DIR__ . '/..' . '/defuse/php-encryption/src/Exception/CryptoException.php',
        'Defuse\\Crypto\\Exception\\EnvironmentIsBrokenException' => __DIR__ . '/..' . '/defuse/php-encryption/src/Exception/EnvironmentIsBrokenException.php',
        'Defuse\\Crypto\\Exception\\IOException' => __DIR__ . '/..' . '/defuse/php-encryption/src/Exception/IOException.php',
        'Defuse\\Crypto\\Exception\\WrongKeyOrModifiedCiphertextException' => __DIR__ . '/..' . '/defuse/php-encryption/src/Exception/WrongKeyOrModifiedCiphertextException.php',
        'Defuse\\Crypto\\File' => __DIR__ . '/..' . '/defuse/php-encryption/src/File.php',
        'Defuse\\Crypto\\Key' => __DIR__ . '/..' . '/defuse/php-encryption/src/Key.php',
        'Defuse\\Crypto\\KeyOrPassword' => __DIR__ . '/..' . '/defuse/php-encryption/src/KeyOrPassword.php',
        'Defuse\\Crypto\\KeyProtectedByPassword' => __DIR__ . '/..' . '/defuse/php-encryption/src/KeyProtectedByPassword.php',
        'Defuse\\Crypto\\RuntimeTests' => __DIR__ . '/..' . '/defuse/php-encryption/src/RuntimeTests.php',
        'Firebase\\JWT\\BeforeValidException' => __DIR__ . '/..' . '/firebase/php-jwt/src/BeforeValidException.php',
        'Firebase\\JWT\\ExpiredException' => __DIR__ . '/..' . '/firebase/php-jwt/src/ExpiredException.php',
        'Firebase\\JWT\\JWK' => __DIR__ . '/..' . '/firebase/php-jwt/src/JWK.php',
        'Firebase\\JWT\\JWT' => __DIR__ . '/..' . '/firebase/php-jwt/src/JWT.php',
        'Firebase\\JWT\\Key' => __DIR__ . '/..' . '/firebase/php-jwt/src/Key.php',
        'Firebase\\JWT\\SignatureInvalidException' => __DIR__ . '/..' . '/firebase/php-jwt/src/SignatureInvalidException.php',
        'Raygun4php\\Raygun4PhpException' => __DIR__ . '/..' . '/mindscape/raygun4php/src/Raygun4php/Raygun4PhpException.php',
        'Raygun4php\\RaygunClient' => __DIR__ . '/..' . '/mindscape/raygun4php/src/Raygun4php/RaygunClient.php',
        'Raygun4php\\RaygunClientMessage' => __DIR__ . '/..' . '/mindscape/raygun4php/src/Raygun4php/RaygunClientMessage.php',
        'Raygun4php\\RaygunEnvironmentMessage' => __DIR__ . '/..' . '/mindscape/raygun4php/src/Raygun4php/RaygunEnvironmentMessage.php',
        'Raygun4php\\RaygunExceptionMessage' => __DIR__ . '/..' . '/mindscape/raygun4php/src/Raygun4php/RaygunExceptionMessage.php',
        'Raygun4php\\RaygunExceptionTraceLineMessage' => __DIR__ . '/..' . '/mindscape/raygun4php/src/Raygun4php/RaygunExceptionTraceLineMessage.php',
        'Raygun4php\\RaygunIdentifier' => __DIR__ . '/..' . '/mindscape/raygun4php/src/Raygun4php/RaygunIdentifier.php',
        'Raygun4php\\RaygunMessage' => __DIR__ . '/..' . '/mindscape/raygun4php/src/Raygun4php/RaygunMessage.php',
        'Raygun4php\\RaygunMessageDetails' => __DIR__ . '/..' . '/mindscape/raygun4php/src/Raygun4php/RaygunMessageDetails.php',
        'Raygun4php\\RaygunRequestMessage' => __DIR__ . '/..' . '/mindscape/raygun4php/src/Raygun4php/RaygunRequestMessage.php',
        'WP_Async_Request' => __DIR__ . '/..' . '/a5hleyrich/wp-background-processing/classes/wp-async-request.php',
        'WP_Background_Process' => __DIR__ . '/..' . '/a5hleyrich/wp-background-processing/classes/wp-background-process.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcf64331d344d60cdd7c271d9659d62f2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcf64331d344d60cdd7c271d9659d62f2::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitcf64331d344d60cdd7c271d9659d62f2::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitcf64331d344d60cdd7c271d9659d62f2::$classMap;

        }, null, ClassLoader::class);
    }
}
