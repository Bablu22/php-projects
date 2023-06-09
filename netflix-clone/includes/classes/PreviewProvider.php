<?php
include_once("includes/classes/Entity.php");
include_once("includes/classes/EntityProvider.php");

class PreviewProvider
{
    private $con, $username;

    public function __construct($con, $username)
    {
        $this->con = $con;
        $this->username = $username;
    }

    public function createPreviewVideo($entity): string
    {
        if ($entity == null) {
            $entity = $this->getRandomEntity();
        }
        $id = $entity->getId();
        $name = $entity->getName();
        $thumbnail = $entity->getThumbnail();
        $preview = $entity->getPreview();
        return "<div class='previewContainer'>
                    <img src='$thumbnail' class='previewImage' hidden alt='thumbnail'>

                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>
                    <div class='previewOverlay'>
                        <div class='mainDetails'>
                            <h3>$name</h3>
                           
                            <div class='buttons'>
                                <button ><i class='fas fa-play'></i> </button>
                                <button onclick='volumeToggle(this)'><i class='fas fa-volume-mute'></i></button>
                            </div>

                        </div>

                    </div>
        
                </div>";
    }


    public function createEntityPreviewSquare($entity): string
    {
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        return "<a href='entity.php?id=$id'>
                    <div class='previewContainer small'>
                        <img src='$thumbnail' title='$name' alt='thumbnail'>
                    </div>
                </a>";
    }

    private function getRandomEntity()
    {
        $entity = EntityProvider::getEntities($this->con, null, 1);
        return $entity[0];
    }
}


