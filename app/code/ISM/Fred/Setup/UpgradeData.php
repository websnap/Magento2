<?php

namespace ISM\Fred\Setup;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Store\Model\StoreManager;
use Magento\Eav\Setup\EavSetupFactory;

class UpgradeData implements UpgradeDataInterface
{
    public $storeManager;
    protected $objectManager;

    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    public function __construct(ObjectManagerInterface $objectManager,
                                StoreManager $storeManager,
                                EavSetupFactory $eavSetupFactory )
    {
        $this->objectManager = $objectManager;
        $this->storeManager = $storeManager;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $shabbies_b2c_nl = $this->storeManager->getStore('shabbies_b2c_nl')->getId();
        $shabbies_b2c_en = $this->storeManager->getStore('shabbies_b2c_en')->getId();
        $shabbies_b2c_de = $this->storeManager->getStore('shabbies_b2c_de')->getId();
        $fred_b2c_nl = $this->storeManager->getStore('fred_b2c_nl')->getId();
        $fred_b2c_en = $this->storeManager->getStore('fred_b2c_en')->getId();
        $fred_b2c_de = $this->storeManager->getStore('fred_b2c_de')->getId();

        //handle all possible upgrade versions

        if(!$context->getVersion()) {
            //no previous version found, installation, InstallSchema was just executed
            //be careful, since everything below is true for installation !
        }

        if (version_compare($context->getVersion(), '0.1.1') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'header_usp',
                    'title' => '[Header] USP block',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="header-usp">
    <ul>
        <li><span>Gratis verzending (vanaf 50 euro)</span></li>
        <li><span>Kosteloos retourneren</span></li>
    </ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.2') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'website_link_shabbies',
                    'title' => '[Header] website link shabbies',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="header-website-link">
    <a href="#">Shabbies</a>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.3') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'website_link_fred',
                    'title' => '[Header] website link fred',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="header-website-link">
    <a href="#">Fred</a>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.4') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'additional_menu',
                    'title' => '[Top] additional menu',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<nav class="addtitonal-menu">
    <li><a href="#">GET INSPirED</a></li>
    <li><a href="#">winkels</a></li>
</nav>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.5') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'home_banner',
                    'title' => '[Home] banner',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="banner-wrapper">
<ul class="banner-items">
<li><img src="{{view url="images/banner.png"}}" alt="/" />
<div class="banner-content">
<div class="custom-controls"><span class="prev">&nbsp;</span> <span class="next">&nbsp;</span></div>
<h2>Party essentials</h2>
<p>Van pump tot clutch voor elke party outfit.</p>
<a class="action primary btn-type-b" href="#"><span>SHOP ONLINE</span></a></div>
</li>
<li><img src="{{view url="images/banner.png"}}" alt="/" />
<div class="banner-content">
<div class="custom-controls"><span class="prev">&nbsp;</span> <span class="next">&nbsp;</span></div>
<h2>Party essentials2</h2>
<p>Van pump tot clutch voor elke party outfit.2</p>
<a class="action primary btn-type-b" href="#"><span>SHOP ONLINE2</span></a></div>
</li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.6') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_a',
                    'title' => '[Home, Landing] block with product',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-a-wrapper">
<ul>
<li>
<h2>De comeback
van de Chelsea</h2>
</li>
<li class="circular-view-wrapper">
<a href="#">
<img src="{{view url="images/pr1.1.png"}}" alt="/">
<span>bekijk 360˚</span>
</a>
</li>
<li>
<p>Ugitature, sinulle ndipiendis dolorest, core verio qui ut labo. Itas autem aliquam, cus etus derro vel elit rerspidios voloremped quis et unt et, cons
equi cum fugit et audam, inus apit eum ent.</p>
<a href="#" class="action primary">bekijk onze chelsea’s</a>
</li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.7') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_b',
                    'title' => '[Home, Landing] block with two images',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-b-wrapper">
<ul>
<li class="item-with-img">
<img src="{{view url="images/bl2.1.png"}}" alt="/">
<div class="position-wrapper"><a class="action primary" href="#">bekijk alle tassen</a></div>
</li>
<li  class="item-with-text">
<h2>Combineer je favoriete schoudertas</h2>
</li>
<li  class="item-with-img">
<img src="{{view url="images/bl2.2.png"}}" alt="/">
<div class="position-wrapper"><a class="action primary" href="#">SHOP ONLINE</a></div>
</li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.8') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_c',
                    'title' => '[Home, Landing] block with text',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-c-wrapper">
<h3>WE ARE DARING IN THAT WE DON’T FOLLOW FASHION, BUT OUR OWN AUTHENTIC SENSE OF AESTHETICS”</h3>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.9') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_d',
                    'title' => '[Home, Landing] block with two images (small and big)',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-d-wrapper">
<ul>
<li class="item-with-img"><img src="{{view url="images/bl3.2.png"}}" alt="/" /></li>
<li class="item-with-text">
<div class="item-text-type-d">
<h2>Uniek in detail</h2>
<p>Ugitature, sinulle ndipiendis dolorest, core verio qui ut labo itas autem aliqua derro vel.</p>
<a class="action primary">bekijk alle sandalen</a></div>
</li>
<li class="item-with-img small-img-item"><img src="{{view url="images/bl3.1.png"}}" alt="/" />
<div class="position-wrapper"><a class="action primary" href="#">SHOP ONLINE</a></div>
</li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.10') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_e',
                    'title' => '[Home, Landing] block with author and video',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-e-wrapper"><img class="block-custom-bg" src="{{view url='images/video-bg.jpg'}}" alt="/" />
<ul>
<li class="item-with-author">
<div class="author-wrapper"><img src="{{view url='images/author.png'}}" alt="/" /><img src="{{view url='images/sh-product.jpg'}}" alt="/" /><span class="author-name">Hellen, Designer</span>
<p>Ugitature, sinulle ndipiendis do lorest, core veriot labo itas.</p>
<a class="action primary" href="#">meer lezen</a></div>
</li>
<li class="item-with-video">
<div class="video-item-text-wrapper">
<h2>De oorsprong van de Espadrille</h2>
<a class="action primary video-btn" href="https://youtu.be/sZdOd1ASqVo" target="_blank">bekijk de video</a></div>
</li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.11') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_f',
                    'title' => '[Landing] block with image and text',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-f-wrapper">
<img src="{{view url="images/bl2.1.1.png"}}" alt="/" />
<div class="block-type-f-content">
<h2>Taupe touch</h2>
<p>Ugitature, sinulle ndipiendis dolorest, core verio qui ut labo. Itas autem aliquam, cus etus derro.</p>
<a class="action primary" href="#"><span>bekijk taupe tassen</span></a>
</div>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.12') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'size_table',
                    'title' => '[PDP] size table' ,
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="size-link"><span>Maattabel</span></div>
<div class="size-popup-wrapper no-display">
<div class="size-chart-popup"><img src="{{view url="images/size-chart.jpg"}}" alt="" /></div>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.13') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'pdp_usp',
                    'title' => '[PDP] USP block' ,
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<ul class="pdp-usp-block">
<li class="item">Gratis verzending (vanaf 50 euro)</li>
<li class="item">Werkdagen voor 17.00 uur besteld, morgen in huis</li>
<li class="item">kostenloos retourneren</li>
</ul>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.14') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'delivery_return_information',
                    'title' => '[PDP] Delivery and return information' ,
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec quam eu purus gravida ultrices. Morbi eget nisi id odio aliquet sodales. Cras interdum ac urna sit amet finibus. Ut vehicula lacus non nibh posuere consequat. Aliquam pellentesque quis diam id tempus. Vivamus tincidunt ornare varius.</p>
</div>
<ul>
<li>Gratis verzending (vanaf 50 euro)</li>
<li>Werkdagen voor 17.00 uur besteld, morgen in huis</li>
<li>kostenloos retourneren</li>
</ul>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.15') < 0) {
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'gallery_static_block',
                [
                    'type' => 'varchar',
                    'label' => 'Gallery CMS Block',
                    'input' => 'select',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'source' => 'Magento\Catalog\Model\Category\Attribute\Source\Page',
                    'group' => 'generic',
                    'required' => false,
                    'user_defined' => true,
                    'visible_on_front' => false,
                    'used_in_product_listing' => true
                ]);

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'gallery_content_title',
                [
                    'type' => 'varchar',
                    'label' => 'Gallery Content Title',
                    'input' => 'text',
                    'source' => '',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => true,
                    'default' => null,
                    'group' => 'generic',
                    'backend' => ''
                ]);

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'gallery_content_text',
                [
                    'type' => 'text',
                    'label' => 'Gallery Content Text',
                    'input' => 'textarea',
                    'source' => '',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => true,
                    'default' => null,
                    'group' => 'generic',
                    'wysiwyg_enabled' => true,
                    'backend' => ''
                ]);
                // for revert: UPDATE `setup_module` set schema_version	= '0.1.14', data_version =  '0.1.14' where `module` = 'ISM_Fred' ;
        }

        if (version_compare($context->getVersion(), '0.1.16') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'link_and_product',
                    'title' => '[Home, Landing page]  Block with product widget' ,
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="widget-type-b">
<div class="type-b-content">
<h2>De handtassen musthaves</h2>
<a class="action primary" href="#">bekijk deze</a></div>
<div class="type-b-product">
<div class="product-wrapper">{{widget type="Magento\CatalogWidget\Block\Product\ProductsList" products_count="10" template="product/widget/content/grid.phtml" conditions_encoded="a:1:[i:1;a:4:[s:4:`type`;s:50:`Magento|CatalogWidget|Model|Rule|Condition|Combine`;s:10:`aggregator`;s:3:`all`;s:5:`value`;s:1:`1`;s:9:`new_child`;s:0:``;]]"}}</div>
</div>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }
        
        if (version_compare($context->getVersion(), '0.1.17') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'footer_links',
                    'title' => 'Footer links' ,
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<ul class="footer links">
<li class="nav item"><a href="{{store url=''}}blog/">Blog</a></li>
<li class="nav item"><a href="{{store url=''}}search/term/popular/">Search Terms</a></li>
<li class="nav item"><a href="{{store url=''}}privacy-policy-cookie-restriction-mode/">Privacy and Cookie Policy</a></li>
<li class="nav item"><a href="{{store url=''}}sales/guest/form/">Orders and Returns</a></li>
<li class="nav item"><a href="{{store url=''}}contact/">Contact Us</a></li>
<li class="nav item"><a href="{{store url=''}}catalogsearch/advanced/" data-action="advanced-search">Advanced Search</a></li>
</ul>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.18') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'home_banner',
                    'title' => '[Home] banner',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="banner-wrapper">
<ul class="banner-items">
<li><img src="{{view url="images/banner.png"}}" alt="/" />
<div class="banner-mobile-title">
<h2>Party essentials</h2>
</div>
<div class="banner-content">
<h2>Party essentials</h2>
<p>Van pump tot clutch voor elke party outfit.</p>
<a class="action primary btn-type-c" href="#"><span>Shop online</span></a></div>
</li>
<li><img src="{{view url="images/banner.png"}}" alt="/" />
<div class="banner-mobile-title">
<h2>Party essentials2</h2>
</div>
<div class="banner-content">
<h2>Party essentials2</h2>
<p>Van pump tot clutch voor elke party outfit.2</p>
<a class="action primary btn-type-c" href="#"><span>Shop online2</span></a></div>
</li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.19') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_a',
                    'title' => '[Home, Landing] block with product',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-a-wrapper">
<ul>
<li>
<h2>De comeback
van de Chelsea</h2>
</li>
<li class="circular-view-wrapper">
<a href="#">
<img src="{{view url="images/pr1.1.png"}}" alt="/">
</a>
</li>
<li>
<p>Ugitature, sinulle ndipiendis dolorest, core verio qui ut labo. Itas autem aliquam, cus etus derro vel elit rerspidios voloremped quis et unt et, cons
equi cum fugit et audam, inus apit eum ent.</p>
<a href="#" class="action primary">bekijk onze chelsea’s</a>
</li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.20') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_b',
                    'title' => '[Home, Landing] block with two images',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-b-wrapper">
<ul>
<li class="item-with-img">
<img src="{{view url="images/product.png"}}" alt="/">
<div class="position-wrapper"><a class="action primary" href="#">bekijk alle tassen</a></div>
</li>
<li  class="item-with-text">
<h2>Combineer je favoriete schoudertas</h2>
</li>
<li  class="item-with-img">
<img src="{{view url="images/product.png"}}" alt="/">
<div class="position-wrapper"><a class="action primary" href="#">Shop online</a></div>
</li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.21') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_e',
                    'title' => '[Home, Landing] block with author and video',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-e-wrapper"><img class="block-custom-bg" src="{{view url='images/video-bg2.jpg'}}" alt="/" />
<ul>
<li class="item-with-author">
<div class="author-wrapper"><img src="{{view url='images/author.png'}}" alt="/" />
<span class="author-name">Hellen, Designer</span>
<p>Ugitature, sinulle ndipiendis do lorest, core veriot labo itas.</p>
<a class="action primary" href="#">meer lezen</a></div>
</li>
<li class="item-with-video">
<div class="video-item-text-wrapper">
<h2>De oorsprong van de Espadrille</h2>
<a class="action primary video-btn" href="https://youtu.be/sZdOd1ASqVo" target="_blank">bekijk de video</a></div>
</li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.22') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'link_and_product',
                    'title' => '[Home, Landing page]  Block with product widget' ,
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="widget-type-b">
    <div class="type-b-content">
        <h2>De handtassen musthaves</h2>
        <a class="action primary" href="#">bekijk deze</a>
    </div>
    <div class="type-b-product">
        <div class="product-wrapper">{{widget type="Magento\CatalogWidget\Block\Product\ProductsList" products_count="10" template="product/widget/content/grid.phtml" conditions_encoded="a:1:[i:1;a:4:[s:4:`type`;s:50:`Magento|CatalogWidget|Model|Rule|Condition|Combine`;s:10:`aggregator`;s:3:`all`;s:5:`value`;s:1:`1`;s:9:`new_child`;s:0:``;]]"}}</div>
    </div>
    <div class="type-b-content-mobile">
        <a class="action primary" href="#">bekijk deze</a>
    </div>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.23') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_f',
                    'title' => '[Landing] block with image and text',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-f-wrapper">
<img src="{{view url="images/bl2.1.1.png"}}" alt="/" />
<div class="banner-mobile-title">
<h2>Party essentials</h2>
</div>
<div class="block-type-f-content">
<h2>Taupe touch</h2>
<p>Ugitature, sinulle ndipiendis dolorest, core verio qui ut labo. Itas autem aliquam, cus etus derro.</p>
<a class="action primary" href="#"><span>bekijk taupe tassen</span></a>
</div>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.26') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'home_banner_shabbies',
                    'title' => '[Shabbies Home] banner',
                    'stores' => array($shabbies_b2c_nl, $shabbies_b2c_en, $shabbies_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="banner-wrapper page-main">
<ul class="banner-items ">
<li><img src="{{view url="images/banner-1.jpg"}}" alt="/" />
<div class="banner-mobile-title">
<h2>new summer collection</h2>
</div>
<div class="banner-content">
<h2>new summer collection</h2>
<p>Graecre nonsultorum tris vive<br />ndam. Simil te alaturs aut es<br />mus vissis, culis Ful ivign quit.<a class="action primary" href="#"><span>show the collection</span></a></p>
</div>
</li>
<li><img src="{{view url="images/banner-1.jpg"}}" alt="/" />
<div class="banner-mobile-title">
<h2>new summer collection2</h2>
</div>
<div class="banner-content">
<h2>new summer collection2</h2>
<p>Graecre nonsultorum tris vive<br />ndam. Simil te alaturs aut es<br />mus vissis, culis Ful ivign quit.2<a class="action primary" href="#"><span>show the collection</span></a></p>
</div>
</li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.27') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'link_and_product_shabbies',
                    'title' => '[Shabbies Home, Landing page]  Block with product widget' ,
                    'stores' => array($shabbies_b2c_nl, $shabbies_b2c_en, $shabbies_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="widget-type-b page-main">
    <div class="type-b-content">
        <h2>enkellaarsjes musthaves</h2>
        <a class="action primary" href="#">shop nu</a>
    </div>
    <div class="type-b-product">
        <div class="product-wrapper">{{widget type="Magento\CatalogWidget\Block\Product\ProductsList" products_count="10" template="product/widget/content/grid.phtml" conditions_encoded="a:1:[i:1;a:4:[s:4:`type`;s:50:`Magento|CatalogWidget|Model|Rule|Condition|Combine`;s:10:`aggregator`;s:3:`all`;s:5:`value`;s:1:`1`;s:9:`new_child`;s:0:``;]]"}}</div>
    </div>
    <div class="type-b-content-mobile">
        <a class="action primary" href="#">shop nu</a>
    </div>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.28') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_b_shabbies',
                    'title' => '[Shabbies Home, Landing] block with two images',
                    'stores' => array($shabbies_b2c_nl, $shabbies_b2c_en, $shabbies_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-b-wrapper clearfix">
<ul>
<li class="item-with-img"><img src="{{view url="images/olive1.png"}}" alt="/" /></li>
<li class="item-with-text">
<h2>dark olive the ultimate colour</h2>
<a class="action primary" href="#">bekijk olijf groen</a></li>
<li class="item-with-img"><img src="{{view url="images/olive2.png"}}" alt="/" /></li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.29') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_c_shabbies',
                    'title' => '[Shabbies Home, Landing] block with text',
                    'stores' => array($shabbies_b2c_nl, $shabbies_b2c_en, $shabbies_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-c-wrapper page-main">
<h3>_WE PROMISE TO BRING YOU</h3>
<h3>THE ESSENTIAL BOOT AND BAG_</h3>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.30') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'instagram_shabbies',
                    'title' => '[Shabbies Home, Landing] instagram',
                    'stores' => array($shabbies_b2c_nl, $shabbies_b2c_en, $shabbies_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-instagram-wrapper">
<div class="follow-instagram"><img src="{{view url='images/instagram-logo.png'}}" alt="/" />
<h4>INSTAGRAM inspiration</h4>
<a class="action primary" href="#">FOLLOW US</a>
<div class="custom-controls"><span class="prev">&lt;</span> <span class="next">&gt;</span></div>
</div>
<ul class="instagram-carousel">
<li><img src="{{view url='images/in2.png'}}" alt="/" /></li>
<li><img src="{{view url='images/in3.png'}}" alt="/" /></li>
<li><img src="{{view url='images/in4.png'}}" alt="/" /></li>
<li><img src="{{view url='images/in5.png'}}" alt="/" /></li>
<li><img src="{{view url='images/in6.png'}}" alt="/" /></li>
<li><img src="{{view url='images/in7.png'}}" alt="/" /></li>
<li><img src="{{view url='images/in2.png'}}" alt="/" /></li>
<li><img src="{{view url='images/in3.png'}}" alt="/" /></li>
<li><img src="{{view url='images/in4.png'}}" alt="/" /></li>
<li><img src="{{view url='images/in5.png'}}" alt="/" /></li>
<li><img src="{{view url='images/in6.png'}}" alt="/" /></li>
<li><img src="{{view url='images/in7.png'}}" alt="/" /></li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.31') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_e_shabbies',
                    'title' => '[Shabbies Home, Landing] block with author and video shabbies',
                    'stores' => array($shabbies_b2c_nl, $shabbies_b2c_en, $shabbies_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-e-wrapper page-main">
<div class="block-type-e-child-wrapper"><img class="block-custom-bg" src="{{view url='images/video-bg.jpg'}}" alt="/" />
<ul>
<li class="item-with-author">
<div class="author-wrapper"><img src="{{view url='images/author-3.png'}}" alt="/" /> <span class="author-name">Hellen, Designer</span>
<p>Ugitature, sinulle ndipiendis do lorest, core veriot labo itas.</p>
</div>
</li>
<li class="item-with-video">
<div class="video-item-text-wrapper"><img class="block-custom-bg" src="{{view url='images/video-bg.jpg'}}" alt="/" />
<h2>headline about the craftmanship movie</h2>
<a class="video-btn" href="https://youtu.be/sZdOd1ASqVo" target="_blank">bekijk de video</a></div>
</li>
</ul>
</div>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.33') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'block_type_g_shabbies',
                    'title' => '[Shabbies Home, Landing] block with 4 product',
                    'stores' => array($shabbies_b2c_nl, $shabbies_b2c_en, $shabbies_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="block-type-g-wrapper">
<div class="page-main block-type-g-content">
<div class="block-g-left-col">
<h2>dark olive</h2>
<img src="{{view url='images/dark-olive.png'}}" alt="/" /></div>
<div class="block-g-right-col">
<ul class="block-g-products">
<li><img src="{{view url='images/bl-pr-1.png'}}" alt="/" /></li>
<li><a href="#"><img src="{{view url='images/bl-pr-2.png'}}" alt="/" /></a></li>
<li><a href="#"><img src="{{view url='images/bl-pr-3.png'}}" alt="/" /></a></li>
<li><img src="{{view url='images/bl-pr-4.png'}}" alt="/" /></li>
</ul>
</div>
</div>
</div>
<div class="block-g-product-banner page-main">
<h3>dark olive</h3>
<ul class="block-g-product-list">
<li><a href="#"><img src="{{view url='images/bl-pr-1.png'}}" alt="/" /></a></li>
<li><a href="#"><img src="{{view url='images/bl-pr-2.png'}}" alt="/" /></a></li>
<li><a href="#"><img src="{{view url='images/bl-pr-3.png'}}" alt="/" /></a></li>
<li><a href="#"><img src="{{view url='images/bl-pr-4.png'}}" alt="/" /></a></li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.34') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'home_banner',
                    'title' => '[Home] banner',
                    'stores' => [0],
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="banner-wrapper">
<ul class="banner-items">
<li>
<div class="banner-content">
<h2>Party essentials</h2>
<p>Van pump tot clutch voor elke party outfit.</p>
<a class="action primary btn-type-c" href="#"><span>Shop online</span></a></div>
<img src="{{view url='images/banner.png'}}" alt="/" /></li>
<li>
<div class="banner-content">
<h2>Party essentials2</h2>
<p>Van pump tot clutch voor elke party outfit.2</p>
<a class="action primary btn-type-c" href="#"><span>Shop online2</span></a></div>
<img src="{{view url='images/banner.png'}}" alt="/" /></li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.41') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'footer_link_to_stores',
                    'title' => '[FRED, Footer] Link to stores',
                    'stores' => array($fred_b2c_nl, $fred_b2c_en, $fred_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="link-to-stores page-main">
    <ul class="items">
        <li class="item current-store"><a href="#"><img src="{{view url='images/logo-fred.png'}}" alt="/" /></a></li>
        <li class="item"><a href="#"><img src="{{view url='images/logo-shabbies.png'}}" alt="/" /></a></li>
    </ul>
</div>
HTML
                ),
                array(
                    'identifier' => 'footer_link_to_stores',
                    'title' => '[SHABBIES, Footer] Link to stores',
                    'stores' => array($shabbies_b2c_nl, $shabbies_b2c_en, $shabbies_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="link-to-stores page-main">
    <ul class="items">
        <li class="item"><a href="#"><img src="{{view url='images/logo-fred.png'}}" alt="/" /></a></li>
        <li class="item current-store"><a href="#"><img src="{{view url='images/logo-shabbies.png'}}" alt="/" /></a></li>
    </ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.42') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'footer_usp',
                    'title' => '[FRED, Footer] USP',
                    'stores' => array($fred_b2c_nl, $fred_b2c_en, $fred_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="footer-usp">
<div class="page-main">
<ul class="items clearfix">
<li class="item"><span>GRATIS VERZENDING</span></li>
<li class="item"><span>KOSTELOOS RETOURNEREN</span></li>
<li class="item"><span>VEILIG ONLINE BETALEN</span></li>
</ul>
</div>
</div>
HTML
                ),
                array(
                    'identifier' => 'footer_usp',
                    'title' => '[SHABBIES, Footer] USP',
                    'stores' => array($shabbies_b2c_nl, $shabbies_b2c_en, $shabbies_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="footer-usp">
<div class="page-main">
<ul class="items clearfix">
<li class="item"><span>GRATIS VERZENDING</span></li>
<li class="item"><span>KOSTELOOS RETOURNEREN</span></li>
<li class="item"><span>VEILIG ONLINE BETALEN</span></li>
</ul>
</div>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.43') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'footer_payment',
                    'title' => '[FRED, Footer] Payment',
                    'stores' => array($fred_b2c_nl, $fred_b2c_en, $fred_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="footer-payment">
<div class="page-main"><strong class="title">Betaal veilig via:</strong>
<ul class="items">
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/master-card.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/pay-pal.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/master-card.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/pay-pal.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/master-card.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/pay-pal.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/master-card.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/pay-pal.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/master-card.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/pay-pal.png'}}" alt="/" /></a></li>
</ul>
</div>
</div>
HTML
                ),
                array(
                    'identifier' => 'footer_payment',
                    'title' => '[SHABBIES, Footer] Payment',
                    'stores' => array($shabbies_b2c_nl, $shabbies_b2c_en, $shabbies_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="footer-payment">
<div class="page-main"><strong class="title">Betaal veilig via:</strong>
<ul class="items">
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/master-card.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/pay-pal.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/master-card.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/pay-pal.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/master-card.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/pay-pal.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/master-card.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/pay-pal.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/master-card.png'}}" alt="/" /></a></li>
<li class="item"><a href="{{store url=''}}path-to-page/"><img src="{{view url='images/pay-pal.png'}}" alt="/" /></a></li>
</ul>
</div>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.44') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'footer_bottom_menu',
                    'title' => '[FRED, Footer] Bottom menu',
                    'stores' => array($fred_b2c_nl, $fred_b2c_en, $fred_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="footer-bottom-menu page-main clearfix">
<ul class="items">
<li class="item"><a href="#">Privacy statement</a></li>
<li class="item"><a href="#">Disclaimer</a></li>
<li class="item"><a href="#">Cookies</a></li>
<li class="item"><a href="#">Algemene voorwaarden</a></li>
</ul>
</div>
HTML
                ),
                array(
                    'identifier' => 'footer_bottom_menu',
                    'title' => '[SHABBIES, Footer] Bottom menu',
                    'stores' => array($shabbies_b2c_nl, $shabbies_b2c_en, $shabbies_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="footer-bottom-menu page-main clearfix">
<ul class="items">
<li class="item"><a href="#">Privacy statement</a></li>
<li class="item"><a href="#">Disclaimer</a></li>
<li class="item"><a href="#">Cookies</a></li>
<li class="item"><a href="#">Algemene voorwaarden</a></li>
</ul>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        if (version_compare($context->getVersion(), '0.1.45') < 0) {
            $cmsBlocks = array(
                array(
                    'identifier' => 'footer_links',
                    'title' => '[FRED, Footer] links',
                    'stores' => array($fred_b2c_nl, $fred_b2c_en, $fred_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="footer-links-wrapper">
<div class="page-main clearfix">
<div class="list"><strong class="title">Over ons</strong>
<ul class="items">
<li class="nav item"><a href="{{store url=''}}path-to-page/">Over Fred de la Bretoniere</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Blog</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Vacatures</a></li>
</ul>
<ul class="items">
<li class="nav item"><a href="{{store url=''}}path-to-page/">B2B webshop</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Pressroom</a></li>
</ul>
</div>
<div class="list"><strong class="title">Klantenservice</strong>
<ul class="items">
<li class="nav item"><a href="{{store url=''}}path-to-page/">Over Fred de la Bretoniere</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Over Fred de la Bretoniere</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Blog</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Contact</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Search</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Over Fred de la Bretoniere</a></li>
</ul>
</div>
<div class="list"><strong class="title">Social media</strong>
<ul class="items social-links">
<li class="nav item facebook"><a href="{{store url=''}}path-to-page/">Facebook</a></li>
<li class="nav item instagram"><a href="{{store url=''}}path-to-page/">Instagram</a></li>
<li class="nav item pinterest"><a href="{{store url=''}}path-to-page/">Pinterest</a></li>
<li class="nav item twitter"><a href="{{store url=''}}path-to-page/">Twitter</a></li>
</ul>
</div>
</div>
</div>
HTML
                ),
                array(
                    'identifier' => 'footer_links',
                    'title' => '[SHABBIES, Footer] links',
                    'stores' => array($shabbies_b2c_nl, $shabbies_b2c_en, $shabbies_b2c_de),
                    'is_active' => 1,
                    'content' => <<<HTML
<div class="footer-links-wrapper">
<div class="page-main clearfix">
<div class="list"><strong class="title">Over ons</strong>
<ul class="items">
<li class="nav item"><a href="{{store url=''}}path-to-page/">Over Fred de la Bretoniere</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Blog</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Vacatures</a></li>
</ul>
<ul class="items">
<li class="nav item"><a href="{{store url=''}}path-to-page/">B2B webshop</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Pressroom</a></li>
</ul>
</div>
<div class="list"><strong class="title">Klantenservice</strong>
<ul class="items">
<li class="nav item"><a href="{{store url=''}}path-to-page/">Over Fred de la Bretoniere</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Over Fred de la Bretoniere</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Blog</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Contact</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Search</a></li>
<li class="nav item"><a href="{{store url=''}}path-to-page/">Over Fred de la Bretoniere</a></li>
</ul>
</div>
<div class="list"><strong class="title">Social media</strong>
<ul class="items social-links">
<li class="nav item facebook"><a href="{{store url=''}}path-to-page/">Facebook</a></li>
<li class="nav item instagram"><a href="{{store url=''}}path-to-page/">Instagram</a></li>
<li class="nav item pinterest"><a href="{{store url=''}}path-to-page/">Pinterest</a></li>
<li class="nav item twitter"><a href="{{store url=''}}path-to-page/">Twitter</a></li>
</ul>
</div>
</div>
</div>
HTML
                )
            );

            //delete CMS blocks if exists
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $block = $modelBlock->load($cmsBlock['identifier'], 'identifier');
                if ($block->getId()) {
                    $block->delete();
                }

            }

            //add new CMS blocks
            foreach ($cmsBlocks as $cmsBlock) {
                $modelBlock = $this->objectManager->create('Magento\Cms\Model\Block');
                $modelBlock->setData($cmsBlock)->save();
            }
        }

        $setup->endSetup();
    }
}