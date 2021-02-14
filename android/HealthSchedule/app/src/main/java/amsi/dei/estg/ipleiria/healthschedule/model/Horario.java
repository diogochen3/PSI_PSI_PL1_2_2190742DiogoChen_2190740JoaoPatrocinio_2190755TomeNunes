package amsi.dei.estg.ipleiria.healthschedule.model;

public class Horario {
    private int id;
    private String date;
    private int usado;

    public Horario(int id, String date, int usado) {
        this.id = id;
        this.date = date;
        this.usado = usado;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public int getUsado() {
        return usado;
    }

    public void setUsado(int usado) {
        this.usado = usado;
    }
}
