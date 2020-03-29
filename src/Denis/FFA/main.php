<?php
/**
*
*  _____                    _            
/  __ \                  | |           
| /  \/  ___   _ __ ___  | |__    ___  
| |     / _ \ | '_ ` _ \ | '_ \  / _ \ 
| \__/\| (_) || | | | | || |_) || (_) |
 \____/ \___/ |_| |_| |_||_.__/  \___/



______ ______   ___  
|  ___||  ___| / _ \ 
| |_   | |_   / /_\ \
|  _|  |  _|  |  _  |
| |    | |    | | | |
\_|    \_|    \_| |_/
                     
                     

                     
                    
                                       
                                       
* © Copyright Plugin made by iTzDxnisHD
*/
// NAMESPACE
namespace Denis\FFA;

//USES
//Base
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\PluginTask;
//Utils
use pocketmine\utils\TextFormat as Color;
use pocketmine\utils\Config;
//EventListener
use pocketmine\event\Listener;
//PlayerEvents
use pocketmine\Player;
use pocketmine\event\player\PlayerHungerChangeEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\player\PlayerMoveEvent;
//ItemUndBlock
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
//BlockEvents
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
//EntityEvents
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\entity\Effect;
//Level
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
//Sounds
use pocketmine\level\sound\AnvilFallSound;
use pocketmine\level\sound\BlazeShootSound;
use pocketmine\level\sound\GhastSound;
//Commands
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
//Tile
use pocketmine\tile\Sign;
use pocketmine\tile\Chest;
use pocketmine\tile\Tile;
//Nbt
use pocketmine\nbt\NBT;
use pocketmine\nbt\tag\ByteTag;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\ShortTag;
use pocketmine\nbt\tag\StringTag;
//Inventar
use pocketmine\inventory\ChestInventory;
use pocketmine\inventory\Inventory;
use pocketmine\event\inventory\InventoryCloseEvent;
use pocketmine\event\inventory\InventoryPickupItemEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;

/**
 * 
 */
class main extends PluginBase implements Listener
{
  
  public $prefix = "§l§7Combo§dFFA §r§8» §7";
  
  /**
   * 
   */
  public function onEnable(): void
  {
    // code...
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->saveDefaultConfig();
    $this->config = new Config($this->getDataFolder() . "settings.yml", Config::YAML);
  }
  
  public function onJoin(PlayerJoinEvent $event)
  {
    $player = $event->getPlayer();
    $name = $player->getName();
    
    $event->setJoinMessage($this->prefix . $this->config->get("JoinMessage"));
    
    $spawn = $this->getServer()->getDefaultLevel()->getSafeSpawn();
        $this->getServer()->getDefaultLevel()->loadChunk($spawn->getX(), $spawn->getZ());
        $player->teleport($spawn, 0, 0);
        $player->setGamemode(0);
        $player->setHealth(20);
        $player->setFood(20);
        $player->getInventory()->clearAll();
        $helm = Item::get(310, 0, 1);
        $chest = Item::get(311, 0, 1);
        $hose = Item::get(312, 0, 1);
        $boots = Item::get(313, 0, 1);
        $item = new Item(Item::DIAMOND_SWORD);
        $item->setCustomName("§7Dia-Schwert");
        $player->getArmorInventory()->setHelmet($helm);
        $player->getArmorInventory()->setChestplate($chest);
        $player->getArmorInventory()->setLeggings($hose);
        $player->getArmorInventory()->setBoots($boots);
  }
  
  public function onRespawn(PlayerRespawnEvent $event)
  {
    $player = $event->getPlayer();
    $spawn = $this->getServer()->getDefaultLevel()->getSafeSpawn();
        $this->getServer()->getDefaultLevel()->loadChunk($spawn->getX(), $spawn->getZ());
        $player->teleport($spawn, 0, 0);
        $player->setGamemode(0);
        $player->setHealth(20);
        $player->setFood(20);
        $player->getInventory()->clearAll();
        $helm = Item::get(310, 0, 1);
        $chest = Item::get(311, 0, 1);
        $hose = Item::get(312, 0, 1);
        $boots = Item::get(313, 0, 1);
        $item = new Item(Item::DIAMOND_SWORD);
        $item->setCustomName("§7Dia-Schwert");
        $player->getArmorInventory()->setHelmet($helm);
        $player->getArmorInventory()->setChestplate($chest);
        $player->getArmorInventory()->setLeggings($hose);
        $player->getArmorInventory()->setBoots($boots);
  }
  
  public function onMove(PlayerMoveEvent $event) {
    	
    	$player = $event->getPlayer();
        $y = $player->getY();
        if ($y > 21) {
        	
        	$effect = Effect::getEffect(10);
            $effect->setAmplifier(5);
            $effect->setDuration(150);
            $player->addEffect($effect);
        	
        }
    	
    }
    
    public function onPlace(BlockPlaceEvent $event) {
    
        $player = $event->getPlayer();
        $config = $this->getConfig();
        $event->setCancelled(true);
        
    }
    
    public function onBreak(BlockBreakEvent $event) {
    
        $player = $event->getPlayer();
        $config = $this->getConfig();
        $event->setCancelled(true);
        
    }
    
    public function onDeath(PlayerDeathEvent $event) {
    	
    	$player = $event->getEntity();
        $event->setDrops(array());
        $event->setDeathMessage($this->prefix . $player->getDisplayName() . "ist Gestorben!");
    	
    }
    
    public function onEntityDamage(EntityDamageByEntityEvent $event){

        $killer = $event->getDamager();
        $opfer = $event->getEntity();

        if($opfer instanceof Player and $killer instanceof Player){
            if($event->getBaseDamage() > $opfer->getHealth()){
                $opfer->setHealth(20);
                $opfer->sendMessage($this->prefix . $killer->getNameTag() . " hat dich Getötet!");
                $opfer->teleport($opfer->getSpawn());

                $reg = $killer->getHealth() + 6;
                $killer->setHealth($reg);
                $killer->sendMessage($this->prefix . "Du hast" . $opfer->getNameTag() . " getötet!");
            }
        }
      }
        
        public function onQuit(PlayerQuitEvent $event)
        {
          $player = $event->getPlayer();
          $name = $player->getName();
          $event->setQuitMessage($this->prefix . $this->config->get("QuitMessage"));
        }
}
