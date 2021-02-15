package amsi.dei.estg.ipleiria.healthschedule.model;

public class Receita {

private int id, codigo_acesso, codigo_dispensa,id_consulta;
private String data_emissao;

    public Receita(int id, int codigo_acesso, int codigo_dispensa, int id_consulta, String data_emissao) {
        this.id = id;
        this.codigo_acesso = codigo_acesso;
        this.codigo_dispensa = codigo_dispensa;
        this.id_consulta = id_consulta;
        this.data_emissao = data_emissao;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getCodigo_acesso() {
        return codigo_acesso;
    }

    public void setCodigo_acesso(int codigo_acesso) {
        this.codigo_acesso = codigo_acesso;
    }

    public int getCodigo_dispensa() {
        return codigo_dispensa;
    }

    public void setCodigo_dispensa(int codigo_dispensa) {
        this.codigo_dispensa = codigo_dispensa;
    }

    public int getId_consulta() {
        return id_consulta;
    }

    public void setId_consulta(int id_consulta) {
        this.id_consulta = id_consulta;
    }

    public String getData_emissao() {
        return data_emissao;
    }

    public void setData_emissao(String data_emissao) {
        this.data_emissao = data_emissao;
    }
}
