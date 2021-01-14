package amsi.dei.estg.ipleiria.healthschedule.model;

public class Especialidade {
    private int id;
    private String Name;


    public Especialidade(int id, String Name) {
        this.id = id;
        this.Name = Name;
    }

    public void setName(String Name) {
        this.Name = Name;
    }

    public int getId() {
        return id;
    }

    public String getName() {
        return Name;
    }

    public void setId(int id) { this.id = id; }
}