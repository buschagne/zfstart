namespace Album\Model;

class Album
{
    protected $id;
    protected $artist;
    protected $title;

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->artist = (isset($data['artist'])) ? $data['artist'] : null;
        $this->title  = (isset($data['title'])) ? $data['title'] : null;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    //You get the idea for the rest, I'm sure
}

//Then to access those properties:-

$album = new Album();
$album->setId(123);

$albumId = $album->getId();
