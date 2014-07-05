#include<stdio.h>
#define MAX 100
typedef struct
{
    int i,j;
    int tri;
}triple;
typedef struct{
  triple date[MAX+1];
  int mu,nu;
  int tu;
}Matrix;
void init(Matrix *m)
{

    int k;
    printf("请输入矩阵的行数与列数：");
    scanf("%d",&(*m).mu);
    scanf("%d",&(*m).nu);
    printf("请输入非零元素的个数：");
    scanf("%d",&(*m).tu);
    printf("请分别输入您%d个非零元素的行下标，列下标，与它的值:",(*m).tu);
    for(k=1;k<=(*m).tu;k++)
        scanf("%d%d%d",&(*m).date[k].i,&(*m).date[k].j,&(*m).date[k].tri);
}
void print(Matrix m){
    int k,p;
    int n=1;
    for(k=1;k<=m.mu;k++){
        for(p=1;p<=m.nu;p++){
            if(k==m.date[n].i&&p==m.date[n].j){
                printf("%d ",m.date[n].tri);
                n++;
            }
            else printf("0 ");
}
printf("\n");
}
}

void Transmat(Matrix m,Matrix *n)//方法一 按照M中列去扫描所有的date当遇到列值一样的时候 先扫描到的肯定会小，所以在n中排的位置是正确的
{
    (*n).mu=m.mu;
    (*n).nu=m.nu;
    (*n).tu=m.tu;
    int k,p;
    int q=1;
    for(k=1;k<=m.nu;k++)
        for(p=1;p<=m.tu;p++)
        if(m.date[p].j==k)
            {
            (*n).date[q].i=m.date[p].j;
            (*n).date[q].j=m.date[p].i;
            (*n).date[q].tri=m.date[p].tri;
            q++;
            }

}
void Transmat2(Matrix m,Matrix *n)//方法2 快速转置 求得每一列中非零元的 个数 ，以及第一个非零元的位置。
{
    int k;int col;
    int q;
    int num[m.nu+1];
    int cpot[m.nu+1];
    (*n).mu=m.mu;
    (*n).nu=m.nu;
    (*n).tu=m.tu;
    for(k=1;k<=m.nu;k++)
        num[k]=0;
    for(k=1;k<=m.tu;k++)
        num[m.date[k].j]++;
    cpot[1]=1;
    for(k=2;k<m.nu;k++)
        cpot[k]=cpot[k-1]+num[k-1];
    for(k=1;k<=m.tu;k++)
    {
        col=m.date[k].j;
        q=cpot[col];
        (*n).date[q].i=m.date[k].j;
        (*n).date[q].j=m.date[k].i;
        (*n).date[q].tri=m.date[k].tri;
        cpot[col]++;
    }
}
int main()
{
    Matrix m,n,p;
    init(&m);
    printf("您的非零元个数为：");
    printf("%d\n",m.tu);
    printf("您的初始矩阵为：\n");
    print(m);
    printf("\n");
    Transmat(m,&n);
    printf("通过第一种方法得到的转置矩阵为：\n");
    print(n);
    printf("\n");
    Transmat(m,&p);
     printf("通过第二种方法得到的转置矩阵为：\n");
    print(p);
    return 0;
}

