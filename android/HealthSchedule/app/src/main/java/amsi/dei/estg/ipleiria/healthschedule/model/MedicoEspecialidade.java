package amsi.dei.estg.ipleiria.healthschedule.model;

public class MedicoEspecialidade {
    private int id_Especialidade, id_Medico;

    public MedicoEspecialidade(int id_Especialidade, int id_Medico) {
        this.id_Especialidade = id_Especialidade;
        this.id_Medico = id_Medico;
    }

    public int getId_Especialidade() {
        return id_Especialidade;
    }

    public void setId_Especialidade(int id_Especialidade) {
        this.id_Especialidade = id_Especialidade;
    }

    public int getId_Medico() {
        return id_Medico;
    }

    public void setId_Medico(int id_Medico) {
        this.id_Medico = id_Medico;
    }
}
